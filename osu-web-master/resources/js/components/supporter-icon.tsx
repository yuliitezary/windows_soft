// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { times } from 'lodash';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';

interface Props {
  level?: number;
  modifiers?: string[];
}

export const SupporterIcon = (props: Props) => {
  const className = classWithModifiers('supporter-icon', props.modifiers);

  return (
    <span className={className} title={trans('users.show.is_supporter')}>
      {
        times(props.level || 1, (n) => <span key={n} className='fas fa-heart' />)
      }
    </span>
  );
};
