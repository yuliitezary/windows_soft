// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetJson from './beatmapset-json';
import FollowJson from './follow-json';
import UserJson from './user-json';

export default interface FollowMappingJson extends FollowJson {
  latest_beatmapset?: BeatmapsetJson;
  user: UserJson;
}
