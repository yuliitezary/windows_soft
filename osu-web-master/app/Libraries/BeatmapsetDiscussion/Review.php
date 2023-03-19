<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\BeatmapsetDiscussion;

use App\Exceptions\InvariantException;
use App\Jobs\Notifications\BeatmapsetDiscussionReviewNew;
use App\Libraries\BeatmapsetDiscussion\Traits\HandlesProblem;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\User;

class Review
{
    use HandlesProblem;

    const BLOCK_TEXT_LENGTH_LIMIT = 750;

    private bool $isUpdate;

    private function __construct(
        private Beatmapset $beatmapset,
        private User $user,
        private array $document,
        private ?BeatmapDiscussion $discussion = null
    ) {
        if (empty($document)) {
            throw new InvariantException(osu_trans('beatmap_discussions.review.validation.invalid_document'));
        }

        $this->isUpdate = $this->discussion !== null;
    }

    public static function config()
    {
        return [
            'max_blocks' => config('osu.beatmapset.discussion_review_max_blocks'),
        ];
    }

    public static function create(Beatmapset $beatmapset, array $document, User $user)
    {
        return (new static($beatmapset, $user, $document))->process();
    }

    public static function getStats(array $document)
    {
        $stats = [
            'praises' => 0,
            'suggestions' => 0,
            'problems' => 0,
        ];
        $embedIds = [];

        foreach ($document as $block) {
            if ($block['type'] === 'embed') {
                $embedIds[] = $block['discussion_id'];
            }
        }

        $embeds = BeatmapDiscussion::whereIn('id', $embedIds)->get();
        foreach ($embeds as $embed) {
            switch ($embed->message_type) {
                case 'praise':
                    $stats['praises']++;
                    break;

                case 'suggestion':
                    $stats['suggestions']++;
                    break;

                case 'problem':
                    $stats['problems']++;
                    break;
            }
        }

        return $stats;
    }

    public static function update(BeatmapDiscussion $discussion, array $document, User $user)
    {
        // fail if updating on deleted beatmapset.
        $beatmapset = Beatmapset::findOrFail($discussion->beatmapset_id);

        return (new static($beatmapset, $user, $document, $discussion))->process();
    }

    private function createDiscussion(string $discussionType, string $message, int $beatmapId = null, string $timestamp = null)
    {
        $userId = $this->user->getKey();

        $newDiscussion = new BeatmapDiscussion([
            'beatmapset_id' => $this->beatmapset->getKey(),
            'user_id' => $userId,
            'resolved' => false,
            'message_type' => $discussionType,
            'timestamp' => $timestamp,
            'beatmap_id' => $beatmapId,
        ]);

        $this->maybeSetProblemDiscussion($newDiscussion);

        $newDiscussion->saveOrExplode();

        $postParams = [
            'user_id' => $userId,
            'message' => $message,
        ];
        $newPost = new BeatmapDiscussionPost($postParams);
        $newPost->beatmapDiscussion()->associate($newDiscussion);
        $newPost->saveOrExplode();

        return $newDiscussion;
    }

    private function parseBlock($block)
    {
        if (!isset($block['type'])) {
            throw new InvariantException(osu_trans('beatmap_discussions.review.validation.invalid_block_type'));
        }

        $message = get_string($block['text'] ?? null);
        // message check can be skipped for updates if block is embed and has discussion_id set.
        if ($message === null && !($this->isUpdate && $block['type'] === 'embed' && isset($block['discussion_id']))) {
            throw new InvariantException(osu_trans('beatmap_discussions.review.validation.missing_text'));
        }

        switch ($block['type']) {
            case 'embed':
                if ($this->isUpdate && isset($block['discussion_id'])) {
                    $childId = $block['discussion_id'];
                } else {
                    if (!isset($block['discussion_type'])) {
                        throw new InvariantException(osu_trans('beatmap_discussions.review.validation.invalid_discussion_type'));
                    }

                    $embeddedDiscussion = $this->createDiscussion(
                        $block['discussion_type'],
                        $message,
                        $block['beatmap_id'] ?? null,
                        $block['timestamp'] ?? null
                    );

                    $childId = $embeddedDiscussion->getKey();
                }

                return [
                    'type' => 'embed',
                    'discussion_id' => $childId,
                ];

            case 'paragraph':
                if (mb_strlen($block['text']) > static::BLOCK_TEXT_LENGTH_LIMIT) {
                    throw new InvariantException(osu_trans('beatmap_discussions.review.validation.block_too_large', ['limit' => static::BLOCK_TEXT_LENGTH_LIMIT]));
                }
                return [
                    'type' => 'paragraph',
                    'text' => $block['text'],
                ];

            default:
                // invalid block type
                throw new InvariantException(osu_trans('beatmap_discussions.review.validation.invalid_block_type'));
        }
    }

    private function parseDocument()
    {
        $output = [];
        // create the issues for the embeds first
        foreach ($this->document as $block) {
            $output[] = $this->parseBlock($block);
        }

        $childIds = array_values(array_filter(array_pluck($output, 'discussion_id')));

        $minIssues = config('osu.beatmapset.discussion_review_min_issues');
        if (empty($childIds) || count($childIds) < $minIssues) {
            throw new InvariantException(osu_trans_choice('beatmap_discussions.review.validation.minimum_issues', $minIssues));
        }

        $maxBlocks = config('osu.beatmapset.discussion_review_max_blocks');
        $blockCount = count($this->document);
        if ($blockCount > $maxBlocks) {
            throw new InvariantException(osu_trans_choice('beatmap_discussions.review.validation.too_many_blocks', $maxBlocks));
        }

        return [$output, $childIds];
    }

    private function process()
    {
        $this->beatmapset->getConnection()->transaction(function () {
            [$output, $childIds] = $this->parseDocument();

            if (!$this->isUpdate) {
                $this->discussion = $this->createDiscussion(
                    'review',
                    json_encode($output)
                );
            } else {
                // ensure all referenced embeds belong to this discussion
                $externalEmbeds = BeatmapDiscussion::whereIn('id', $childIds)->where('parent_id', '<>', $this->discussion->getKey())->count();
                if ($externalEmbeds > 0) {
                    throw new InvariantException(osu_trans('beatmap_discussions.review.validation.external_references'));
                }

                // update the review post
                $post = $this->discussion->startingPost;
                $post['message'] = json_encode($output);
                $post['last_editor_id'] = $this->user->getKey();
                $post->saveOrExplode();

                // unlink any embeds that were removed from the review
                BeatmapDiscussion::where('parent_id', $this->discussion->getKey())
                    ->whereNotIn('id', $childIds)
                    ->update(['parent_id' => null]);
            }

            // associate children with parent
            BeatmapDiscussion::whereIn('id', $childIds)
                ->update(['parent_id' => $this->discussion->getKey()]);

            $this->handleProblemDiscussion();

            if (!$this->isUpdate) {
                // TODO: make transactional
                (new BeatmapsetDiscussionReviewNew($this->discussion, $this->user))->dispatch();
            }
        });

        return $this->discussion;
    }
}
