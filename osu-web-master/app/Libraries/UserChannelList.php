<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\Chat\Channel;
use App\Models\Chat\UserChannel;
use App\Models\User;
use App\Transformers\Chat\ChannelTransformer;
use Ds\Map;
use Ds\Set;
use Illuminate\Support\Collection;

class UserChannelList
{
    private Collection $channels;

    public function __construct(private User $user)
    {
    }

    public function get()
    {
        $this->loadChannels();
        $this->preloadUsers();

        $filteredChannels = $this->channels->filter(fn (Channel $channel) => $channel->isVisibleFor($this->user));

        $transformer = ChannelTransformer::forUser($this->user);

        return json_collection($filteredChannels, $transformer, ChannelTransformer::LISTING_INCLUDES);
    }

    public function getChannels(): Collection
    {
        if (!isset($this->channels)) {
            $this->loadChannels();
        }

        return $this->channels;
    }

    private function loadChannels()
    {
        $userChannels = UserChannel::where('user_id', $this->user->getKey())
            ->where('hidden', false)
            ->whereHas('channel')
            ->with('channel')
            ->limit(config('osu.chat.channel_limit'))
            ->get();

        foreach ($userChannels as $userChannel) {
            // preset userChannel for getting last_read_id.
            $userChannel->channel->setUserChannel($userChannel);
        }

        $this->channels = $userChannels->pluck('channel');
    }

    private function preloadUsers()
    {
        // Getting user list; Limited to PM channels due to large size of public channels.
        $userIds = new Set();
        $pmChannels = $this->channels->filter(fn ($channel) => $channel->isPM());
        foreach ($pmChannels as $channel) {
            $userIds->add(...$channel->userIds());
        }

        $users = User::default()
            ->whereIn('user_id', $userIds->toArray())
            ->with([
                // only fetch data related to $user, to be used by ChatPmStart/ChatChannelCanMessage privilege check
                'friends' => fn ($query) => $query->where('zebra_id', $this->user->getKey()),
                'blocks' => fn ($query) => $query->where('zebra_id', $this->user->getKey()),
            ])
            ->get();

        // If any channel users are blocked, preload the user groups of those users for the isModerator check.
        $blockedIds = $users->pluck('user_id')->intersect($this->user->blocks->pluck('user_id'));
        if ($blockedIds->isNotEmpty()) {
            // Yes, the sql will look stupid.
            $users->load(['userGroups' => fn ($query) => $query->whereIn('user_id', $blockedIds)]);
        }

        $usersMap = new Map();
        foreach ($users as $user) {
            $usersMap->put($user->getKey(), $user);
        }

        foreach ($pmChannels as $channel) {
            $channel->setPmUsers(array_map(fn ($id) => $usersMap->get($id, null), $channel->userIds()));
        }
    }
}
