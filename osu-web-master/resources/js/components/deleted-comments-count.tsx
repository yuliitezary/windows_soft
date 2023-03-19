// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Comment } from 'models/comment';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { transChoice } from 'utils/lang';

interface Props {
  comments: Comment[];
  modifiers: string[] | undefined;
}

export default class DeletedCommentsCount extends React.Component<Props> {
  render() {
    const deletedCount = this.props.comments.filter((c) => c.deletedAt != null).length;

    if (deletedCount === 0) {
      return null;
    }

    return (
      <div className={classWithModifiers('deleted-comments-count', this.props.modifiers)}>
        <span className='deleted-comments-count__icon'>
          <span className='far fa-trash-alt' />
        </span>
        {transChoice('comments.deleted_count', deletedCount)}
      </div>
    );
  }
}
