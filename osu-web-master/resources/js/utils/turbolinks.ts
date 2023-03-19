// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { TurbolinksAction } from 'turbolinks';

export function currentUrl() {
  return window.newUrl ?? document.location;
}

export function currentUrlParams() {
  const url = currentUrl();

  if (url instanceof URL) {
    return url.searchParams;
  } else {
    return new URLSearchParams(url.search);
  }
}

export function currentUrlRelative() {
  const url = currentUrl();

  return `${url.pathname}${url.search}`;
}

function keepScrollOnLoad() {
  const { pageXOffset, pageYOffset } = window;
  $(document).one('turbolinks:load', () => window.scrollTo(pageXOffset, pageYOffset));
}

export function navigate(url: string, keepScroll = false, { action }: TurbolinksAction = { action: 'advance' }) {
  if (keepScroll) {
    keepScrollOnLoad();
  }

  Turbolinks.visit(url, { action });
}

export function reloadPage(keepScroll = true) {
  $(document).off('.ujsHideLoadingOverlay');
  Turbolinks.clearCache();

  navigate(currentUrl().href, keepScroll, { action: 'replace' });
}
