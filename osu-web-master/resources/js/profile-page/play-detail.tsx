// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Mod from 'components/mod';
import { PlayDetailMenu } from 'components/play-detail-menu';
import TimeWithTooltip from 'components/time-with-tooltip';
import { SoloScoreJsonForUser } from 'interfaces/solo-score-json';
import UserJson from 'interfaces/user-json';
import * as React from 'react';
import PpValue from 'scores/pp-value';
import { getArtist, getTitle, rulesetName, shouldShowPp } from 'utils/beatmap-helper';
import { classWithModifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';
import { hasMenu } from 'utils/score-helper';
import { beatmapUrl } from 'utils/url';

const bn = 'play-detail';

interface Props {
  activated: boolean;
  score: SoloScoreJsonForUser;
  showPinSortableHandle?: boolean;
  showPpWeight?: boolean;
  user: UserJson;
}

interface State {
  compact: boolean;
}

export default class PlayDetail extends React.PureComponent<Props, State> {
  render() {
    const { score, user } = this.props;
    const { beatmap, beatmapset } = score;

    let blockClass = classWithModifiers(
      bn,
      this.props.activated ? 'active' : 'highlightable',
      {
        'pin-sortable': this.props.showPinSortableHandle,
      },
    );

    const additionalAttributes: Partial<Record<`data-${string}`, string>> = {};

    if (this.props.showPinSortableHandle) {
      const pinData = score.current_user_attributes.pin;
      additionalAttributes['data-score-pin'] = JSON.stringify(pinData);
      blockClass += ' js-score-pin-sortable';
    }

    const scoreWeight = this.props.showPpWeight ? score.weight : null;

    return (
      <div className={blockClass} {...additionalAttributes}>
        {this.renderPinSortableHandle()}
        <div className={`${bn}__group ${bn}__group--top`}>
          <div className={`${bn}__icon ${bn}__icon--main`}>
            <div className={`score-rank score-rank--full score-rank--${score.rank}`} />
          </div>

          <div className={`${bn}__detail`}>
            <a
              className={`${bn}__title u-ellipsis-overflow`}
              href={beatmapUrl(beatmap, rulesetName(score.ruleset_id))}
            >
              {getTitle(beatmapset)}
              {' '}
              <small className={`${bn}__artist`}>
                {trans('users.show.extra.beatmaps.by_artist', { artist: getArtist(beatmapset) })}
              </small>
            </a>
            <div className={`${bn}__beatmap-and-time`}>
              <span className={`${bn}__beatmap`}>
                {beatmap.version}
              </span>
              <span className={`${bn}__time`}>
                <TimeWithTooltip dateTime={score.ended_at} relative />
              </span>
            </div>
          </div>
        </div>

        <div className={`${bn}__group ${bn}__group--bottom`}>
          <div className={`${bn}__score-detail ${bn}__score-detail--score`}>
            <div className={`${bn}__icon ${bn}__icon--extra`}>
              <div className={`score-rank score-rank--full score-rank--${score.rank}`} />
            </div>
            <div className={`${bn}__score-detail-top-right`}>
              <div className={`${bn}__accuracy-and-weighted-pp`}>
                <span className={`${bn}__accuracy`}>
                  {formatNumber(score.accuracy * 100, 2)}%
                </span>
                {scoreWeight != null && (
                  <span className={`${bn}__weighted-pp`}>
                    {score.pp != null && `${formatNumber(Math.round(scoreWeight.pp))}pp`}
                  </span>
                )}
              </div>

              {scoreWeight != null && (
                <div className={`${bn}__pp-weight`}>
                  {trans('users.show.extra.top_ranks.pp_weight', {
                    percentage: `${formatNumber(Math.round(scoreWeight.percentage))}%`,
                  })}
                </div>
              )}
            </div>
          </div>

          <div className={`${bn}__score-detail ${bn}__score-detail--mods`}>
            {score.mods.map((mod) => <Mod key={mod.acronym} mod={mod.acronym} />)}
          </div>

          <div className={`${bn}__pp`}>
            {shouldShowPp(beatmap) ? (
              <PpValue
                score={score}
                suffix={<span className={`${bn}__pp-unit`}>pp</span>}
              />
            ) : (
              <span title={trans('users.show.extra.top_ranks.not_ranked')}>
                {(beatmap.status === 'loved') ? (
                  <span className='fas fa-heart' />
                ) : (
                  '-'
                )}
              </span>
            )}
          </div>

          <div className={`${bn}__more`}>
            {hasMenu(score) && <PlayDetailMenu score={score} user={user} />}
          </div>
        </div>
      </div>
    );
  }

  private renderPinSortableHandle() {
    if (!this.props.showPinSortableHandle) return;

    return (
      <div className='js-score-pin-sortable-handle hidden-xs sortable-handle sortable-handle--score-pin'>
        <span className='fas fa-bars' />
      </div>
    );
  }
}
