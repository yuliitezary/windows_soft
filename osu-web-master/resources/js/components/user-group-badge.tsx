// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserGroupJson from 'interfaces/user-group-json';
import { route } from 'laroute';
import * as React from 'react';
import { classWithModifiers, groupColour, Modifiers } from 'utils/css';
import { trans } from 'utils/lang';

interface Props {
  group?: UserGroupJson | null;
  modifiers?: Modifiers;
}

export default function UserGroupBadge({ group, modifiers }: Props) {
  if (group == null) {
    return null;
  }

  let children;
  let title = group.name;

  if (group.playmodes != null && group.playmodes.length > 0) {
    children = (
      <div className='user-group-badge__modes'>
        {group.playmodes.map((playmode) => (
          <i key={playmode} className={`fal fa-extra-mode-${playmode}`} />
        ))}
      </div>
    );

    const playmodeNames = group.playmodes
      .map((playmode) => trans(`beatmaps.mode.${playmode}`))
      .join(', ');

    title += ` (${playmodeNames})`;
  }

  const props = {
    children,
    className: classWithModifiers(
      'user-group-badge',
      { probationary: group.is_probationary },
      group.identifier,
      modifiers,
    ),
    'data-label': group.short_name,
    style: groupColour(group),
    title,
  };

  return group.has_listing
    ? <a {...props} href={route('groups.show', { group: group.id })} />
    : <div {...props} />;
}
