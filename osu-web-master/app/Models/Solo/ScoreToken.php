<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Solo;

use App\Models\Beatmap;
use App\Models\Build;
use App\Models\Model;
use App\Models\User;

/**
 * @property \App\Models\Beatmap $beatmap
 * @property int $beatmap_id
 * @property \App\Models\Build|null $build
 * @property int|null $build_id
 * @property \Carbon\Carbon|null $created_at
 * @property int $id
 * @property int $ruleset_id
 * @property \App\Models\Solo\Score $score
 * @property int $score_id
 * @property \Carbon\Carbon|null $updated_at
 * @property \App\Models\User $user
 * @property int $user_id
 */
class ScoreToken extends Model
{
    protected $table = 'solo_score_tokens';

    public function beatmap()
    {
        return $this->belongsTo(Beatmap::class, 'beatmap_id');
    }

    public function build()
    {
        return $this->belongsTo(Build::class, 'build_id');
    }

    public function score()
    {
        return $this->belongsTo(Score::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getAttribute($key)
    {
        return match ($key) {
            'beatmap_id',
            'build_id',
            'id',
            'ruleset_id',
            'score_id',
            'user_id' => $this->getRawAttribute($key),

            'created_at',
            'updated_at' => $this->getTimeFast($key),

            'created_at_json',
            'updated_at_json' => $this->getJsonTimeFast($key),

            'beatmap',
            'build',
            'score',
            'user' => $this->getRelationValue($key),
        };
    }
}
