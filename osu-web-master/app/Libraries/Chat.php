<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Exceptions\API;
use App\Exceptions\InvariantException;
use App\Models\Chat\Channel;
use App\Models\User;
use LaravelRedis as Redis;

class Chat
{
    public static function ack(User $user)
    {
        $channelIds = $user->channels()->public()->pluck((new Channel())->qualifyColumn('channel_id'));
        $userId = $user->getKey();
        $timestamp = time();
        $transaction = Redis::transaction();

        foreach ($channelIds as $channelId) {
            Channel::ack($channelId, $userId, $timestamp, $transaction);
        }

        $transaction->exec();
    }

    public static function createAnnouncement(User $sender, array $rawParams)
    {
        priv_check_user($sender, 'ChatAnnounce')->ensureCan();

        $params = get_params($rawParams, null, [
            'channel:array',
            'message:string',
            'target_ids:int[]',
            'uuid',
        ], ['null_missing' => true]);

        if (!isset($params['target_ids'])) {
            throw new InvariantException('missing target_ids parameter');
        }

        if (!isset($params['channel'])) {
            throw new InvariantException('missing channel parameter');
        }

        $users = User::whereIn('user_id', $params['target_ids'])->get();
        if ($users->isEmpty()) {
            throw new InvariantException('Nobody to broadcast to!');
        }

        $users = $users->push($sender)->uniqueStrict('user_id');

        $channel = (new Channel())->getConnection()->transaction(function () use ($sender, $params, $users) {
            $channel = Channel::createAnnouncement($users, $params['channel'], $params['uuid']);
            static::sendMessage($sender, $channel, $params['message'], false);

            return $channel;
        });

        return $channel;
    }

    // Do the restricted user lookup before calling this.
    public static function sendPrivateMessage(User $sender, User $target, ?string $message, ?bool $isAction, ?string $uuid = null)
    {
        if ($target->is($sender)) {
            abort(422, "can't send message to same user");
        }

        priv_check_user($sender, 'ChatPmStart', $target)->ensureCan();

        return (new Channel())->getConnection()->transaction(function () use ($sender, $target, $message, $isAction, $uuid) {
            $channel = Channel::findPM($target, $sender) ?? Channel::createPM($target, $sender);

            return static::sendMessage($sender, $channel, $message, $isAction, $uuid);
        });
    }

    public static function sendMessage(User $sender, Channel $channel, ?string $message, ?bool $isAction, ?string $uuid = null)
    {
        if ($channel->isPM()) {
            // restricted users should be treated as if they do not exist
            if (optional($channel->pmTargetFor($sender))->isRestricted()) {
                abort(404, 'target user not found');
            }
        }

        priv_check_user($sender, 'ChatChannelSend', $channel)->ensureCan();

        try {
            return $channel->receiveMessage($sender, $message, $isAction ?? false, $uuid);
        } catch (API\ChatMessageEmptyException $e) {
            abort(422, $e->getMessage());
        } catch (API\ChatMessageTooLongException $e) {
            abort(422, $e->getMessage());
        } catch (API\ExcessiveChatMessagesException $e) {
            abort(429, $e->getMessage());
        }
    }
}
