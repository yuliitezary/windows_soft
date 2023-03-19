// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import StringWithComponent from 'components/string-with-component';
import TimeWithTooltip from 'components/time-with-tooltip';
import AchievementJson from 'interfaces/achievement-json';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import AchievementBadgeIcon from './achievement-badge-icon';

interface Props {
  achievedAt?: string;
  achievement: AchievementJson;
}

export default function AchievementBadgePopup({ achievedAt, achievement }: Props) {
  return (
    <div className='tooltip-achievement'>
      <div className='tooltip-achievement__badge'>
        <AchievementBadgeIcon
          achievement={achievement}
          modifiers={{
            'dynamic-height': true,
            locked: achievedAt == null,
          }}
        />
      </div>

      <div className='tooltip-achievement__grouping'>
        {achievement.grouping}
      </div>

      <div className={classWithModifiers('tooltip-achievement__detail-container', { hoverable: achievement.instructions != null })}>
        <div className='tooltip-achievement__detail tooltip-achievement__detail--normal'>
          <div className='tooltip-achievement__name'>
            {achievement.name}
          </div>
          <div
            className='tooltip-achievement__description'
            dangerouslySetInnerHTML={{ __html: achievement.description }}
          />
        </div>
        {achievement.instructions != null && (
          <div className='tooltip-achievement__detail tooltip-achievement__detail--hover'>
            <div
              className='tooltip-achievement__instructions'
              dangerouslySetInnerHTML={{ __html: achievement.instructions }}
            />
          </div>
        )}
      </div>

      {achievedAt != null ? (
        <div className='tooltip-achievement__date'>
          <StringWithComponent
            mappings={{ date: <TimeWithTooltip dateTime={achievedAt} /> }}
            pattern={trans('users.show.extra.achievements.achieved-on')}
          />
        </div>
      ) : (
        <div className='tooltip-achievement__date'>
          {trans('users.show.extra.achievements.locked')}
        </div>
      )}
    </div>
  );
}
