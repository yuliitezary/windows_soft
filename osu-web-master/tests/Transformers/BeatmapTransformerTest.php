<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Transformers;

use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\User;
use Tests\TestCase;

class BeatmapTransformerTest extends TestCase
{
    /** @var Beatmap */
    protected $deletedBeatmap;

    /**
     * @dataProvider groupsDataProvider
     */
    public function testWithOAuth(?string $groupIdentifier)
    {
        $viewer = User::factory()->withGroup($groupIdentifier)->create();
        $this->actAsScopedUser($viewer);

        $json = json_item($this->deletedBeatmap, 'Beatmap');

        $this->assertEmpty($json);
    }

    /**
     * @dataProvider groupsDataProvider
     */
    public function testWithoutOAuth(?string $groupIdentifier, bool $visible)
    {
        $viewer = User::factory()->withGroup($groupIdentifier)->create();
        $this->actAsUser($viewer);

        $json = json_item($this->deletedBeatmap, 'Beatmap');

        if ($visible) {
            $this->assertNotEmpty($json);
        } else {
            $this->assertEmpty($json);
        }
    }

    public function groupsDataProvider()
    {
        return [
            ['admin', true],
            ['bng', true],
            ['gmt', true],
            ['nat', true],
            [null, false],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $beatmapset = Beatmapset::factory()->deleted()->withDiscussion()->create();
        $this->deletedBeatmap = $beatmapset->beatmaps()->first();
        $this->deletedBeatmap->delete();
    }
}
