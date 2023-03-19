// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Spinner } from 'components/spinner';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  isDeleting: boolean;
  modifiers: string[];
  onDelete?: () => void;
  text?: string;
}

@observer
export default class NotificationDeleteButton extends React.Component<Props> {
  static defaultProps = {
    modifiers: [],
  };

  render() {
    if (this.props.isDeleting) {
      return (
        <div className={classWithModifiers('notification-action-button', this.props.modifiers)}>
          <span className='notification-action-button__text'>{this.props.text}</span>
          <div className='notification-action-button__icon'>
            <Spinner />
          </div>
        </div>
      );
    } else {
      return (
        <button
          className={classWithModifiers('notification-action-button', this.props.modifiers)}
          onClick={this.props.onDelete}
          type='button'
        >
          <span className='notification-action-button__text'>{this.props.text}</span>
          <div className='notification-action-button__icon'>
            <span className='fas fa-trash' />
          </div>
        </button>
      );
    }
  }
}
