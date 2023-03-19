// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ShowMoreLink from 'components/show-more-link';
import { Spinner } from 'components/spinner';
import StringWithComponent from 'components/string-with-component';
import UserAvatar from 'components/user-avatar';
import UserCardBrick from 'components/user-card-brick';
import UserLink from 'components/user-link';
import { each, isEmpty, last, throttle } from 'lodash';
import { action, computed, makeObservable, reaction } from 'mobx';
import { disposeOnUnmount, observer } from 'mobx-react';
import Message from 'models/chat/message';
import { deletedUser } from 'models/user';
import * as moment from 'moment';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import InputBox from './input-box';
import { MessageDivider } from './message-divider';
import MessageGroup from './message-group';

type Props = Record<string, never>;

interface Snapshot {
  chatHeight: number;
  chatTop: number;
}

const blankSnapshot = (): Snapshot => ({ chatHeight: 0, chatTop: 0 });

@observer
export default class ConversationView extends React.Component<Props> {
  private chatViewRef = React.createRef<HTMLDivElement>();
  private didSwitchChannel = true;
  private disposers = new Set<(() => void) | undefined>();
  private firstMessage?: Message;
  private unreadMarkerRef = React.createRef<HTMLDivElement>();

  @computed
  private get conversationStack() {
    const channel = this.currentChannel;
    if (channel == null) return [];

    const conversationStack: JSX.Element[] = [];
    let currentGroup: Message[] = [];
    let unreadMarkerShown = false;
    let currentDay: number;

    each(channel.messages, (message: Message, key: number) => {
      // check if the last read indicator needs to be shown
      // when messageId is a uuid, comparison will always be false.
      if (!unreadMarkerShown && message.messageId > (channel.lastReadId ?? -1) && message.sender.id !== core.currentUser?.id) {
        unreadMarkerShown = true;
        // TODO: handle the case where unread messages are in the backlog

        if (!isEmpty(currentGroup)) {
          conversationStack.push(<MessageGroup key={currentGroup[0].uuid} messages={currentGroup} />);
          currentGroup = [];
        }
        conversationStack.push(<MessageDivider key={`read-${message.timestamp}`} ref={this.unreadMarkerRef} timestamp={message.timestamp} type='UNREAD_MARKER' />);
      }

      // check whether the day-change header needs to be shown
      if (isEmpty(conversationStack) || moment(message.timestamp).date() !== currentDay /* TODO: make check less dodgy */) {
        if (!isEmpty(currentGroup)) {
          conversationStack.push(<MessageGroup key={currentGroup[0].uuid} messages={currentGroup} />);
          currentGroup = [];
        }
        conversationStack.push(<MessageDivider key={`day-${message.timestamp}`} timestamp={message.timestamp} type='DAY_MARKER' />);
        currentDay = moment(message.timestamp).date();
      }

      // add message to current message grouping if the sender is the same, otherwise create a new message grouping
      const lastCurrentGroup = last(currentGroup);
      if (lastCurrentGroup == null || lastCurrentGroup.sender.id === message.sender.id) {
        currentGroup.push(message);
      } else {
        conversationStack.push(<MessageGroup key={currentGroup[0].uuid} messages={currentGroup} />);
        currentGroup = [];
        currentGroup.push(message);
      }

      if (key === channel.messages.length - 1) {
        conversationStack.push(<MessageGroup key={currentGroup[0].uuid} messages={currentGroup} />);
      }
    });

    return conversationStack;
  }

  @computed
  private get currentChannel() {
    return core.dataStore.chatState.selectedChannel;
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);

    disposeOnUnmount(
      this,
      reaction(() => core.windowFocusObserver.hasFocus, (value) => {
        // mark as read when regaining focus and at the bottom to the channel.
        if (value && this.currentChannel?.uiState.autoScroll) {
          this.currentChannel.moveMarkAsReadMarker();
          this.currentChannel.throttledSendMarkAsRead();
        }
      }),
    );

    disposeOnUnmount(
      this,
      reaction(() => core.dataStore.chatState.selectedChannel, (newValue, oldValue) => {
        if (newValue !== oldValue) {
          this.didSwitchChannel = true;
        }
      }),
    );
  }

  componentDidMount() {
    this.componentDidUpdate();

    const throttledHandleOnScroll = throttle(this.handleOnScroll, 1000);
    $(window).on('scroll', throttledHandleOnScroll);
    this.disposers.add(() => $(window).off('scroll', throttledHandleOnScroll));
  }

  @action
  componentDidUpdate(prevProps?: Readonly<Props>, prevState?: Readonly<Record<string, never>>, snapshot?: Snapshot) {
    const chatView = this.chatViewRef.current;
    if (!chatView || !this.currentChannel || this.currentChannel.loadingMessages) {
      return;
    }

    const uiState = this.currentChannel.uiState;

    if (this.didSwitchChannel) {
      // This can happen after a turbolinks navigation,
      // so we have to wait for the elements to be on the current document before scrolling.
      this.disposers.add(core.reactTurbolinks.runAfterPageLoad(action(() => {
        if (this.unreadMarkerRef.current) {
          this.scrollToUnread();
        } else {
          if (uiState.autoScroll) {
            this.scrollToBottom();
          } else {
            chatView.scrollTo(0, uiState.scrollY);
          }
        }

        this.didSwitchChannel = false;
      })));
    } else {
      snapshot = snapshot ?? blankSnapshot();
      const prepending = this.firstMessage !== this.currentChannel.firstMessage;

      if (prepending) {
        const newHeight = chatView.scrollHeight;
        chatView.scrollTo(chatView.scrollLeft, snapshot.chatTop + (newHeight - snapshot.chatHeight));
      } else {
        if (uiState.autoScroll) {
          this.scrollToBottom();
        }
      }
    }

    this.firstMessage = this.currentChannel.firstMessage;
  }

  componentWillUnmount() {
    this.disposers.forEach((disposer) => disposer?.());
  }

  getSnapshotBeforeUpdate() {
    const snapshot = blankSnapshot();

    if (this.chatViewRef.current != null) {
      snapshot.chatHeight = this.chatViewRef.current.scrollHeight;
      snapshot.chatTop = this.chatViewRef.current.scrollTop;
    }

    return snapshot;
  }

  render() {
    const channel = this.currentChannel;

    if (channel == null || !channel.isDisplayable) {
      return <div className='chat-conversation' />;
    }

    const renderInput = channel.canMessage || channel.type !== 'ANNOUNCE';
    const className = classWithModifiers('chat-conversation', channel.type, { 'no-input': !renderInput });
    const pmTargetJson = channel.pmTarget == null
      ? null
      : {
        avatar_url: channel.icon,
        id: channel.pmTarget,
        username: channel.name,
      };

    return (
      <>
        <div ref={this.chatViewRef} className={className} onScroll={this.handleOnScroll}>
          <div className='chat-conversation__new-chat-avatar'>
            {pmTargetJson == null ? (
              <UserAvatar user={{ avatar_url: channel.icon }} />
            ) : (
              <UserLink user={pmTargetJson}>
                <UserAvatar user={pmTargetJson} />
              </UserLink>
            )}
          </div>
          {this.renderUsers()}
          <div className='chat-conversation__chat-label'>
            {pmTargetJson == null ? (
              trans('chat.talking_in', { channel: channel.name })
            ) : (
              <StringWithComponent
                mappings={{ name: <UserLink user={pmTargetJson} /> }}
                // TODO: rework this once the user class situation is resolved
                pattern={trans('chat.talking_with')}
              />
            )}
          </div>
          {channel.description &&
            <div className='chat-conversation__chat-label'>
              {channel.description}
            </div>
          }
          <ShowMoreLink
            callback={this.loadEarlierMessages}
            direction='up'
            hasMore={channel.hasEarlierMessages}
            loading={channel.loadingEarlierMessages}
            modifiers='chat-conversation-earlier-messages'
          />
          {channel.loadingMessages &&
            <div className='chat-conversation__day-divider'>
              <Spinner />
            </div>
          }
          {this.conversationStack}
          {!channel.canMessage && renderInput &&
            this.renderCannotSendMessage()
          }
        </div>
        {renderInput && <InputBox />}
      </>
    );
  }

  renderUsers() {
    if (this.currentChannel?.type !== 'ANNOUNCE') return null;

    return (
      <div className={classWithModifiers('chat-conversation__users', { loading: this.currentChannel.announcementUsers == null })}>
        {this.currentChannel.announcementUsers == null ? (
          <>
            <Spinner modifiers='self-center' /><span>{trans('chat.loading_users')}</span>
          </>
        ) : (
          this.currentChannel.announcementUsers.map((user) => (
            <UserCardBrick key={user?.id} user={(user ?? deletedUser).toJson()} />
          ))
        )}
      </div>
    );
  }

  @action
  private handleOnScroll = () => {
    const chatView = this.chatViewRef.current;
    if (chatView == null || this.currentChannel == null) return;

    this.currentChannel.uiState.autoScroll = chatView.scrollTop + chatView.clientHeight >= chatView.scrollHeight;
    this.currentChannel.uiState.scrollY = chatView.scrollTop;
    // keep marker at the end when autoScrolling but only if window has focus.
    if (this.currentChannel.uiState.autoScroll && core.windowFocusObserver.hasFocus) {
      this.currentChannel.moveMarkAsReadMarker();
    }
  };

  private loadEarlierMessages = () => {
    if (this.currentChannel == null) return;
    core.dataStore.channelStore.loadChannelEarlierMessages(this.currentChannel.channelId);
  };

  private renderCannotSendMessage() {
    if (this.currentChannel == null) {
      // this shouldn't happen...
      return;
    }

    const message = this.currentChannel.type === 'PM' ? trans('chat.cannot_send.user') : trans('chat.cannot_send.channel');

    return (
      <div>
        <div className='chat-conversation__cannot-message'>
          {message}
          {' '}
          {this.currentChannel.canMessageError}
        </div>
      </div>
    );
  }

  private scrollToBottom() {
    const chatView = this.chatViewRef.current;
    if (chatView) {
      $(chatView).scrollTop(chatView.scrollHeight);
    }
  }

  private scrollToUnread() {
    const chatView = this.chatViewRef.current;
    if (chatView && this.unreadMarkerRef.current) {
      $(chatView).scrollTop(this.unreadMarkerRef.current.offsetTop);
    }
  }
}
