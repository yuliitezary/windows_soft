// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import FriendUpdated from 'actions/friend-updated';
import { dispatch } from 'app-dispatcher';
import UserRelationJson from 'interfaces/user-relation-json';
import { route } from 'laroute';
import { action, computed, makeObservable, observable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { onErrorWithCallback } from 'utils/ajax';
import { Modifiers, classWithModifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';
import { Spinner } from './spinner';

const bn = 'user-action-button';

interface Props {
  alwaysVisible: boolean;
  container?: HTMLElement;
  followers?: number;
  modifiers?: Modifiers;
  userId: number;
}

@observer
export default class FriendButton extends React.Component<Props> {
  static readonly defaultProps = {
    alwaysVisible: false,
  };

  @observable private followersWithoutSelf: number;
  @observable private loading = false;
  private xhr?: JQuery.jqXHR<UserRelationJson[]>;

  @computed
  private get followers() {
    return this.followersWithoutSelf + (this.friend == null ? 0 : 1);
  }

  @computed
  private get friend() {
    return core.currentUserModel.friends.get(this.props.userId);
  }

  @computed
  private get isFriendLimit() {
    return core.currentUser == null || core.currentUser.friends.length >= core.currentUser.max_friends;
  }

  @computed
  private get isVisible() {
    // - not a guest
    // - not viewing own card
    // - not blocked
    return core.currentUser != null &&
      Number.isFinite(this.props.userId) &&
      this.props.userId !== core.currentUser.id &&
      !core.currentUser.blocks.some((b) => b.target_id === this.props.userId);
  }

  private get showFollowerCounter() {
    return this.props.followers != null;
  }

  @computed
  private get title() {
    if (!this.isVisible) {
      return trans('friends.buttons.disabled');
    }

    if (this.friend != null) {
      return trans('friends.buttons.remove');
    }

    if (this.isFriendLimit) {
      return trans('friends.too_many');
    }

    return trans('friends.buttons.add');
  }

  constructor(props: Props) {
    super(props);

    // FIXME: this should be run again on user id change (also for runInAction below)
    this.followersWithoutSelf = this.props.followers ?? 0;

    makeObservable(this);

    // FIXME: see setting followersWithoutSelf above
    runInAction(() => {
      if (this.friend != null) {
        this.followersWithoutSelf -= 1;
      }
    });
  }

  componentWillUnmount() {
    this.xhr?.abort();
  }

  render() {
    if (!this.props.alwaysVisible && !this.isVisible) {
      return null;
    }

    const extraModifier = this.friend == null || this.loading
      ? null
      : (this.friend.mutual ? 'mutual' : 'friend');

    const blockClass = classWithModifiers(bn, this.props.modifiers, extraModifier);
    const disabled = !this.isVisible || this.loading || this.isFriendLimit && this.friend == null;

    return (
      <div title={this.title}>
        <button className={blockClass} disabled={disabled} onClick={this.clicked} type='button'>
          <span className={`${bn}__icon-container`}>
            {this.renderIcon()}
          </span>
          {this.renderCounter()}
        </button>
      </div>
    );
  }

  @action
  private readonly clicked = () => {
    this.loading = true;

    if (this.friend == null) {
      // friending
      this.xhr = $.ajax(route('friends.store', { target: this.props.userId }), { type: 'POST' });
    } else {
      // un-friending
      this.xhr = $.ajax(route('friends.destroy', { friend: this.props.userId }), { type: 'DELETE' });
    }

    this.xhr
      .done(this.updateFriends)
      .fail(onErrorWithCallback(this.clicked))
      .always(action(() => this.loading = false));
  };

  private renderCounter() {
    if (!this.showFollowerCounter) return;

    return <span className={`${bn}__counter`}>{formatNumber(this.followers)}</span>;
  }

  private renderIcon() {
    if (this.loading) {
      return <Spinner />;
    }

    if (!this.isVisible) {
      return <span className='fas fa-user' />;
    }

    if (this.friend != null) {
      return (
        <>
          <span className={`${bn}__icon ${bn}__icon--hover-visible`}>
            <span className='fas fa-user-times' />
          </span>
          {this.friend.mutual ? (
            <span className={`${bn}__icon ${bn}__icon--hover-hidden`}>
              <span className='fas fa-user-friends' />
            </span>
          ) : (
            <span className={`${bn}__icon ${bn}__icon--hover-hidden`}>
              <span className='fas fa-user' />
            </span>
          )}
        </>
      );
    }

    return <span className={this.isFriendLimit ? 'fas fa-user' : 'fas fa-user-plus'} />;
  }

  @action
  private readonly updateFriends = (data: UserRelationJson[]) => {
    if (core.currentUser == null) return;

    // TODO: move logic to a user object?
    core.currentUser.friends = data;
    $.publish('user:update', core.currentUser);
    dispatch(new FriendUpdated(this.props.userId));
  };
}
