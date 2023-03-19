# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import BeatmapsetEvents from 'components/beatmapset-events'
import { route } from 'laroute'
import * as React from 'react'
import { div, h2, a, img } from 'react-dom-factories'
import { trans } from 'utils/lang'

el = React.createElement

export class Events extends React.Component
  render: =>
    div className: 'page-extra',
      h2 className: 'title title--page-extra', trans('users.show.extra.events.title_longer')
      div className: 'modding-profile-list',
        if @props.events.length == 0
          div className: 'modding-profile-list__empty', trans('users.show.extra.none')
        else
          el React.Fragment, null,
            el BeatmapsetEvents,
              events: @props.events
              mode: 'profile'
              users: @props.users

            a
              className: 'modding-profile-list__show-more'
              href: route('beatmapsets.events.index', user: @props.user.id),
              trans('users.show.extra.events.show_more')
