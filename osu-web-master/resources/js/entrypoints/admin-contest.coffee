# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton'
import { createElement } from 'react'
import { parseJson } from 'utils/json'
import { UserEntryList } from 'admin/contest/user-entry-list'

core.reactTurbolinks.register 'admin-contest-user-entry-list', (container) ->
  createElement UserEntryList,
    container: container
    contest: parseJson('json-contest')
    entries: parseJson('json-contest-entries')
