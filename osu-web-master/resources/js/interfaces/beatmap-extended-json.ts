// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJson from './beatmap-json';

export function isValid(x: BeatmapJson | BeatmapExtendedJson): x is BeatmapExtendedJson {
  return (x as BeatmapExtendedJson).accuracy != null;
}

export default interface BeatmapExtendedJson extends BeatmapJson {
  accuracy: number;
  ar: number;
  bpm: number;
  convert: boolean | null;
  count_circles: number;
  count_sliders: number;
  count_spinners: number;
  cs: number;
  deleted_at: string | null;
  drain: number;
  hit_length: number;
  is_scoreable: boolean;
  last_updated: string;
  mode_int: number;
  passcount: number;
  playcount: number;
  ranked: number;
  url: string;
}
