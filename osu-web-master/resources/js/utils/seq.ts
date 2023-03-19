// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

let currVal = 0;

export function nextVal() {
  return ++currVal;
}

export function uuid() {
  return Turbolinks.uuid(); // no point rolling our own
}
