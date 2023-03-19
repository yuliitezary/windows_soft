<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Beatmap;

class BeatmapTransformer extends BeatmapCompactTransformer
{
    protected $beatmapsetTransformer = BeatmapsetTransformer::class;
    protected $requiredPermission = 'BeatmapShow';

    protected array $defaultIncludes = [
        'checksum',
    ];

    public function transform(Beatmap $beatmap)
    {
        return array_merge(parent::transform($beatmap), [
            'accuracy' => $beatmap->diff_overall,
            'ar' => $beatmap->diff_approach,
            'bpm' => $beatmap->bpm,
            'convert' => $beatmap->convert,
            'count_circles' => $beatmap->countNormal,
            'count_sliders' => $beatmap->countSlider,
            'count_spinners' => $beatmap->countSpinner,
            'cs' => $beatmap->diff_size,
            'deleted_at' => $beatmap->deleted_at_json,
            'drain' => $beatmap->diff_drain,
            'hit_length' => $beatmap->hit_length,
            'is_scoreable' => $beatmap->isScoreable(),
            'last_updated' => $beatmap->last_update_json,
            'mode_int' => $beatmap->playmode,
            'passcount' => $beatmap->passcount,
            'playcount' => $beatmap->playcount,
            'ranked' => $beatmap->approved,
            'url' => route('beatmaps.show', ['beatmap' => $beatmap->getKey()]),
        ]);
    }
}
