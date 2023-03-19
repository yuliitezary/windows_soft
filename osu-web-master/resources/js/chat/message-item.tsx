// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Spinner } from 'components/spinner';
import { escape } from 'lodash';
import { observer } from 'mobx-react';
import Message from 'models/chat/message';
import * as React from 'react';
import ReactMarkdown from 'react-markdown';
import autolink from 'remark-plugins/autolink';
import disableConstructs from 'remark-plugins/disable-constructs';
import { classWithModifiers } from 'utils/css';
import { linkify } from 'utils/url';

interface Props {
  message: Message;
}

@observer
export default class MessageItem extends React.Component<Props> {
  render() {
    return (
      <div className={classWithModifiers('chat-message-item', { sending: !this.props.message.persisted })}>
        <div className='chat-message-item__entry'>
          {this.props.message.type === 'markdown' ? this.renderMarkdown() : this.renderText()}
          {!this.props.message.persisted && !this.props.message.errored &&
            <div className='chat-message-item__status'>
              <Spinner />
            </div>
          }
          {this.props.message.errored &&
            <div className='chat-message-item__status chat-message-item__status--errored'>
              <i className='fas fa-times' />
            </div>
          }
        </div>
      </div>
    );
  }

  private renderMarkdown() {
    return (
      <ReactMarkdown
        className='osu-md osu-md--chat'
        remarkPlugins={[autolink, [disableConstructs, { type: 'chat' }]]}
        unwrapDisallowed
      >
        {this.props.message.content}
      </ReactMarkdown>
    );
  }

  private renderText() {
    return (
      <span
        className={classWithModifiers('chat-message-item__content', { action: this.props.message.type === 'action' })}
        dangerouslySetInnerHTML={{ __html: linkify(escape(this.props.message.content), true) }}
      />
    );
  }
}
