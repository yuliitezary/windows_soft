<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Jobs\RenumberUserScorePins;
use App\Libraries\MorphMap;
use App\Models\Beatmap;
use App\Models\ScorePin;
use Exception;

class ScorePinsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        parent::__construct();
    }

    public function destroy()
    {
        auth()->user()->scorePins()->where($this->getScoreParams(request()->all()))->delete();

        return response()->noContent();
    }

    public function reorder()
    {
        $rawParams = request()->all();
        $targetParams = $this->getScoreParams($rawParams);

        $pinsQuery = auth()->user()->scorePins();
        $target = $pinsQuery->clone()->where($targetParams)->firstOrFail();

        $adjacentScores = [];
        foreach (['order1', 'order3'] as $position) {
            $adjacentScores[$position] = $this->getScoreParams(get_arr($rawParams[$position] ?? null) ?? []);
        }

        $order1Item = isset($adjacentScores['order1']['score_id'])
            ? $pinsQuery->clone()->where($adjacentScores['order1'])->first()
            : null;
        $order3Item = $order1Item === null && isset($adjacentScores['order3']['score_id'])
            ? $pinsQuery->clone()->where($adjacentScores['order3'])->first()
            : null;

        abort_if($order1Item === null && $order3Item === null, 422, 'no valid pinned score reference is specified');

        if ($order1Item === null) {
            $order3 = $order3Item->display_order;
            $order1 = $pinsQuery->clone()->where('display_order', '<', $order3)->max('display_order')
                ?? $order3 - 200;
        } else {
            $order1 = $order1Item->display_order;
            $order3 = $pinsQuery->clone()->where('display_order', '>', $order1)->min('display_order')
                ?? $order1 + 200;
        }

        $order2 = ($order1 + $order3) / 2;

        if ($order3 - $order1 < 0.1) {
            dispatch(new RenumberUserScorePins($target->user_id, $target->score_type));
        }

        $target->update(['display_order' => $order2]);

        return response()->noContent();
    }

    public function store()
    {
        $params = $this->getScoreParams(request()->all());

        abort_if(!ScorePin::isValidType($params['score_type']), 422, 'invalid score_type');

        $score = MorphMap::getClass($params['score_type'])::find($params['score_id']);

        abort_if($score === null, 422, "specified score couldn't be found");

        $user = auth()->user();

        $pin = ScorePin::where(['user_id' => $user->getKey()])->whereMorphedTo('score', $score)->first();

        if ($pin === null) {
            priv_check('ScorePin', $score)->ensureCan();

            $rulesetId = Beatmap::MODES[$score->getMode()];
            $currentMinDisplayOrder = $user->scorePins()->where('ruleset_id', $rulesetId)->min('display_order') ?? 2500;

            try {
                (new ScorePin(['display_order' => $currentMinDisplayOrder - 100, 'ruleset_id' => $rulesetId]))
                    ->user()->associate($user)
                    ->score()->associate($score)
                    ->saveOrExplode();
            } catch (Exception $ex) {
                if (!is_sql_unique_exception($ex)) {
                    throw $ex;
                }
            }
        }

        return response()->noContent();
    }

    private function getScoreParams(array $form)
    {
        return get_params($form, null, [
            'score_type:string',
            'score_id:int',
        ], ['null_missing' => true]);
    }
}
