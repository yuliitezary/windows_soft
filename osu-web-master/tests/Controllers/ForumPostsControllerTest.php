<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Controllers;

use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use App\Models\User;
use Tests\TestCase;

class ForumPostsControllerTest extends TestCase
{
    public function testDestroy(): void
    {
        $topic = Topic::factory()->withPost()->create();
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'poster_id' => $user,
            'topic_id' => $topic,
        ]);

        $this->expectCountChange(fn () => Post::count(), -1);
        $this->expectCountChange(fn () => Topic::count(), 0);
        $this->expectCountChange(fn () => $topic->fresh()->postCount(), -1);

        $this
            ->actingAsVerified($user)
            ->delete(route('forum.posts.destroy', $post))
            ->assertSuccessful();
    }

    public function testDestroyFirstPost(): void
    {
        $topic = Topic::factory()->create();
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'poster_id' => $user,
            'topic_id' => $topic,
        ]);

        $this->expectCountChange(fn () => Post::count(), 0);
        $this->expectCountChange(fn () => Topic::count(), 0);
        $this->expectCountChange(fn () => $topic->fresh()->postCount(), 0);

        $this
            ->actingAsVerified($user)
            ->delete(route('forum.posts.destroy', $post))
            ->assertStatus(422);
    }

    public function testDestroyNotLastPost(): void
    {
        $topic = Topic::factory()->withPost()->create();
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'poster_id' => $user,
            'topic_id' => $topic,
        ]);
        Post::factory()->create(['topic_id' => $topic]);

        $this->expectCountChange(fn () => Post::count(), 0);
        $this->expectCountChange(fn () => Topic::count(), 0);
        $this->expectCountChange(fn () => $topic->fresh()->postCount(), 0);

        $this
            ->actingAsVerified($user)
            ->delete(route('forum.posts.destroy', $post))
            ->assertStatus(403);
    }

    public function testRestore(): void
    {
        $moderator = User::factory()->withGroup('gmt')->create();
        $topic = Topic::factory()->withPost()->create();
        $post = Post::factory()->create(['topic_id' => $topic]);
        $post->delete();

        $this->expectCountChange(fn () => Post::count(), 1);
        $this->expectCountChange(fn () => $topic->fresh()->postCount(), 1);

        $this
            ->actingAsVerified($moderator)
            ->post(route('forum.posts.restore', $post))
            ->assertSuccessful();
    }
}
