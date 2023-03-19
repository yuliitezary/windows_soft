<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Libraries\BeatmapsetDiscussion\Review;
use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\Beatmapset;
use App\Models\User;
use App\Traits\Memoizes;
use App\Transformers\BeatmapDiscussionTransformer;
use App\Transformers\BeatmapsetTransformer;
use App\Transformers\BeatmapTransformer;
use App\Transformers\UserCompactTransformer;
use Illuminate\Pagination\Paginator;

class BeatmapsetDiscussionsBundle extends BeatmapsetDiscussionsBundleBase
{
    use Memoizes;

    private const DISCUSSION_WITHS = ['beatmapDiscussionVotes', 'beatmap', 'beatmapset', 'startingPost'];

    private $searchParams;

    public function getData()
    {
        return $this->getDiscussions();
    }

    public function getSearchParams()
    {
        return $this->searchParams;
    }

    public function toArray()
    {
        static $discussionIncludes = ['starting_post', 'current_user_attributes'];

        return array_merge([
            'beatmaps' => json_collection($this->getBeatmaps(), new BeatmapTransformer()),
            'beatmapsets' => json_collection($this->getBeatmapsets(), new BeatmapsetTransformer()),
            'discussions' => json_collection($this->getDiscussions(), new BeatmapDiscussionTransformer(), $discussionIncludes),
            'included_discussions' => json_collection($this->getRelatedDiscussions(), new BeatmapDiscussionTransformer(), $discussionIncludes),
            'reviews_config' => Review::config(),
            'users' => json_collection($this->getUsers(), new UserCompactTransformer(), ['groups']),
        ], cursor_for_response($this->getCursor()));
    }

    private function getBeatmaps()
    {
        return $this->memoize(__FUNCTION__, function () {
            // using all beatmaps of the beatmapsets for the beatmap selector when editing.
            $beatmapsetIds = $this->getBeatmapsets()->pluck('beatmapset_id');

            return Beatmap::withTrashed()->whereIn('beatmapset_id', $beatmapsetIds)->get();
        });
    }

    private function getBeatmapsets()
    {
        return $this->memoize(__FUNCTION__, function () {
            $beatmapsetIds = $this->getDiscussions()->pluck('beatmapset_id')->unique()->values();

            // BeatmapDiscussion::beatmapset() includes trashed.
            return Beatmapset::withTrashed()->whereIn('beatmapset_id', $beatmapsetIds)->get();
        });
    }

    private function getDiscussions()
    {
        return $this->memoize(__FUNCTION__, function () {
            ['query' => $query, 'params' => $this->searchParams] = BeatmapDiscussion::search($this->params);

            $discussions = $query->with(static::DISCUSSION_WITHS)->limit($this->searchParams['limit'] + 1)->get();

            $this->paginator = new Paginator(
                $discussions,
                $this->searchParams['limit'],
                $this->searchParams['page'],
                [
                    'path' => Paginator::resolveCurrentPath(),
                    'query' => $this->searchParams, // unfortunately getting query from Paginator is not public.
                ]
            );

            return $this->paginator->getCollection();
        });
    }

    private function getRelatedDiscussions()
    {
        return $this->memoize(__FUNCTION__, function () {
            return BeatmapDiscussion::whereIn('parent_id', $this->getDiscussions()->pluck('id'))->with(static::DISCUSSION_WITHS)->get();
        });
    }

    private function getUsers()
    {
        return $this->memoize(__FUNCTION__, function () {
            $discussions = $this->getDiscussions();

            $allDiscussions = $discussions->merge($this->getRelatedDiscussions());
            $userIds = $allDiscussions->pluck('user_id')->merge($allDiscussions->pluck('startingPost.last_editor_id'))->unique()->values();

            $users = User::whereIn('user_id', $userIds)->with('userGroups');

            if (!$this->isModerator) {
                $users->default();
            }

            return $users->get();
        });
    }
}
