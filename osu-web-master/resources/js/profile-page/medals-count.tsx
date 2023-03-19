// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ValueDisplay from 'components/value-display';
import UserAchievementJson from 'interfaces/user-achievement-json';
import * as React from 'react';
import { trans } from 'utils/lang';

interface Props {
  userAchievements: UserAchievementJson[];
}

export default function MedalsCount({ userAchievements }: Props) {
  return (
    <ValueDisplay
      label={trans('users.show.stats.medals')}
      modifiers='plain'
      value={userAchievements.length}
    />
  );
}
