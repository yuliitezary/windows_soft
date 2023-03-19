// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { action, makeObservable, observable } from 'mobx';

export class FormErrors {
  @observable private errors = new Map<string, string[]>();

  constructor() {
    makeObservable(this);
  }

  @action
  clear() {
    this.errors.clear();
  }

  /**
   * Returns a list of errors with errors for specific input fields filtered out.
   * This works fine for its current use-case and the way validation error keys
   * are currently returned.
   *
   * @param names field names to filter out.
   * @returns List of error messages.
   */
  except(names: string[]): string[] {
    const keys = [...this.errors.keys()].filter((key) => names.every((name) => key !== name));

    const messages: string[] = [];
    for (const key of keys) {
      const strings = this.errors.get(key);
      if (strings != null) {
        strings.forEach((value) => messages.push(value));
      }
    }

    return messages;
  }

  get(name: string) {
    return this.errors.get(name);
  }

  @action
  handleResponse = (xhr: JQueryXHR) => {
    // TODO: extra checks
    // this is also only valid if there aren't more nested keys, which is fine for the current usages.
    const errors = xhr.responseJSON.form_error as Record<string, string[]> | undefined;
    // only handle responses with form_error
    if (errors == null) return;

    this.errors.clear();
    for (const key of Object.keys(errors)) {
      this.errors.set(key, errors[key]);
    }
  };
}
