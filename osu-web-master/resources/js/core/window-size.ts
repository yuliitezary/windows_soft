// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { action, observable, makeObservable } from 'mobx';

export default class WindowSize {
  @observable privateIsDesktop = false;

  get isDesktop() {
    return this.privateIsDesktop;
  }

  get isMobile() {
    return !this.privateIsDesktop;
  }

  constructor() {
    this.handleResize();

    makeObservable(this);

    $(window).on('resize', this.handleResize);
  }

  @action
  handleResize = () => {
    // sync with boostrap-variables @screen-sm-min
    this.privateIsDesktop = window.matchMedia('(min-width: 900px)').matches;
    const vh = window.innerHeight * 0.01;
    /**
     * This works around vh units being inconsistent across browsers (read: on mobile).
     * You can use this in less/css with calc/var, e.g.:
     * height: calc(var(--vh, 1vh) ~'*' 100);
     */
    document.documentElement.style.setProperty('--vh', `${vh}px`);
  };
}
