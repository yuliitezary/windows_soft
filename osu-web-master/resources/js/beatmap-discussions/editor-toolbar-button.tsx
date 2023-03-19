// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { isFormatActive, toggleFormat } from './editor-helpers';
import { SlateContext } from './slate-context';

interface Props {
  format: 'bold' | 'italic';
}

export const EditorToolbarButton = (props: Props) => {
  const context = React.useContext(SlateContext);
  const handleClick = React.useCallback((event: React.SyntheticEvent<HTMLButtonElement>) => {
    event.preventDefault();
    toggleFormat(context, props.format);
  }, [context, props.format]);

  return (
    <button
      className={classWithModifiers('beatmap-discussion-editor-toolbar__button', { active: isFormatActive(context, props.format) })}
      // we use onMouseDown instead of onClick here so the popup remains visible after clicking
      onMouseDown={handleClick}
    >
      <i className={`fas fa-${props.format}`} />
    </button>
  );
};
