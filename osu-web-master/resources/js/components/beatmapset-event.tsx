// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetCover from 'components/beatmapset-cover';
import TimeWithTooltip from 'components/time-with-tooltip';
import BeatmapsetDiscussionJson from 'interfaces/beatmapset-discussion-json';
import BeatmapsetEventJson from 'interfaces/beatmapset-event-json';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { escape, kebabCase } from 'lodash';
import { deletedUser } from 'models/user';
import * as React from 'react';
import { format, makeUrl, previewMessage } from 'utils/beatmapset-discussion-helper';
import { classWithModifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans, transArray } from 'utils/lang';
import { linkHtml } from 'utils/url';

function simpleKebab(str: string | number | undefined) {
  return typeof str === 'string'
    ? str.toLowerCase().replace(/ /g, '-')
    : '';
}

export type EventViewMode = 'discussions' | 'profile' | 'list';

interface Props {
  discussions?: Partial<Record<string, BeatmapsetDiscussionJson>>;
  event: BeatmapsetEventJson;
  mode: EventViewMode;
  time?: string;
  users: Partial<Record<string, UserJson>>;
}

export default class BeatmapsetEvent extends React.PureComponent<Props> {
  private get beatmapsetId(): number | undefined {
    return this.props.event.beatmapset?.id;
  }

  private get discussionId(): number | undefined {
    const comment = this.props.event.comment;
    if (comment != null && typeof comment === 'object' && 'beatmap_discussion_id' in comment) {
      return comment.beatmap_discussion_id;
    }
  }

  // discussion page doesn't include the discussion as part of the event.
  private get discussion() {
    return this.props.event.discussion ?? this.props.discussions?.[this.discussionId ?? ''];
  }

  private get firstPost() {
    const post = this.discussion?.starting_post ?? this.discussion?.posts?.[0];
    return post?.system ? null : post;
  }

  render() {
    return this.props.mode === 'discussions'
      ? this.renderDiscussionsVersion()
      : this.renderProfileVersion();
  }

  renderDiscussionsVersion() {
    const eventTime = this.props.time ?? this.props.event.created_at;

    return (
      <div className='beatmapset-event'>
        <div className='beatmapset-event__icon' style={this.iconStyle()} />
        <div className='beatmapset-event__time'>
          <TimeWithTooltip dateTime={eventTime} format='LT' />
        </div>
        <div
          className={'beatmapset-event__content'}
          dangerouslySetInnerHTML={{
            __html: this.contentText(),
          }}
        />
      </div>
    );
  }

  renderProfileVersion() {
    let discussionLink: string | undefined;
    if (this.beatmapsetId != null) {
      discussionLink = route('beatmapsets.discussion', { beatmapset: this.beatmapsetId });
      if (this.discussionId != null) {
        discussionLink = `${discussionLink}#/${this.discussionId}`;
      }
    }

    return (
      <div className='beatmapset-event'>
        {discussionLink != null ? (
          <a href={discussionLink}>
            <BeatmapsetCover beatmapset={this.props.event.beatmapset} size='list' />
          </a>
        ) : (
          <BeatmapsetCover isDeleted />
        )}
        <div
          className={classWithModifiers('beatmapset-event__icon', ['beatmapset-activities'])}
          style={this.iconStyle()}
        />

        <div>
          <div
            className='beatmapset-event__content'
            dangerouslySetInnerHTML={{
              __html: this.contentText(),
            }}
          />
          <div className='beatmap-discussion-post__info'>
            <TimeWithTooltip dateTime={this.props.event.created_at} relative />
          </div>
        </div>
      </div>
    );
  }

  private contentText() {
    let discussionLink = '';
    let discussionUserLink = '[unknown user]';
    let text = '';
    let url = '';
    let user: string | undefined;

    if (this.discussionId != null) {
      if (this.discussion == null) {
        url = route('beatmapsets.discussions.show', { discussion: this.discussionId });
        text = trans('beatmapset_events.item.discussion_deleted');
      } else {
        const firstPostMessage = this.firstPost?.message;
        url = makeUrl({ discussion: this.discussion });
        text = firstPostMessage != null ? previewMessage(firstPostMessage) : '[no preview]';

        const discussionUser = this.props.users[this.discussion.user_id];

        if (discussionUser != null) {
          discussionUserLink = linkHtml(route('users.show', { user: discussionUser.id }), discussionUser.username);
        }
      }

      discussionLink = linkHtml(url, `#${this.discussionId}`, { classNames: ['js-beatmap-discussion--jump'] });
    } else {
      if (typeof this.props.event.comment === 'string') {
        text = format(this.props.event.comment, { newlines: false });
      }
    }

    if (this.props.event.type === 'discussion_lock' || this.props.event.type === 'remove_from_loved') {
      text = format(this.props.event.comment.reason, { newlines: false });
    }

    if (this.props.event.user_id != null) {
      const userData = this.props.users[this.props.event.user_id];

      if (userData == null) {
        user = escape(deletedUser.username);
      } else {
        user = linkHtml(route('users.show', { user: userData.id }), userData.username);
      }
    }

    const params: Partial<Record<string, number | string>> = {
      discussion: discussionLink,
      discussion_user: discussionUserLink,
      text,
      user,
    };
    if (this.props.event.comment != null && typeof this.props.event.comment === 'object') {
      for (const [commentKey, commentValue] of Object.entries(this.props.event.comment)) {
        if (typeof commentValue === 'number' || typeof commentValue === 'string') {
          params[commentKey] = commentValue;
        }
      }
    }

    let eventType: string = this.props.event.type;

    switch (this.props.event.type) {
      case 'disqualify':
        if (typeof this.props.event.comment === 'string') {
          eventType = 'disqualify_legacy';
        }
        break;
      case 'genre_edit':
        params.new = trans(`beatmaps.genre.${simpleKebab(params.new)}`);
        params.old = trans(`beatmaps.genre.${simpleKebab(params.old)}`);
        break;
      case 'language_edit':
        params.new = trans(`beatmaps.language.${simpleKebab(params.new)}`);
        params.old = trans(`beatmaps.language.${simpleKebab(params.old)}`);
        break;
      case 'nominate': {
        const modes = this.props.event.comment?.modes;
        if (modes != null && modes.length > 0) {
          eventType = 'nominate_modes';
          const nominationModes = modes.map((mode) => trans(`beatmaps.mode.${mode}`));
          params.modes = transArray(nominationModes);
        }
        break;
      }
      case 'nsfw_toggle': {
        const newState = this.props.event.comment?.new ? 'to_1' : 'to_0';
        eventType += `.${newState}`;
        break;
      }
      case 'beatmap_owner_change': {
        const data = this.props.event.comment;
        params.new_user = linkHtml(route('users.show', { user: data.new_user_id }), data.new_user_username);
        params.beatmap = linkHtml(route('beatmaps.show', { beatmap: data.beatmap_id }), data.beatmap_version);
        break;
      }
      case 'nomination_reset_received': {
        const data = this.props.event.comment;
        if (this.props.mode === 'profile') {
          eventType += '_profile';
          params.user = linkHtml(route('users.show', { user: data.source_user_id }), data.source_user_username);
        } else {
          params.source_user = linkHtml(route('users.show', { user: data.source_user_id }), data.source_user_username);
        }
        break;
      }
      case 'offset_edit':
        params.new = formatNumber(this.props.event.comment.new);
        params.old = formatNumber(this.props.event.comment.old);
        break;
    }

    const key = `beatmapset_events.event.${eventType}`;
    let message = trans(key, params);

    // append owner of the event if not already included in main message
    // naive check; we don't use anything other than :user
    if (user != null && !trans(key).includes(':user')) {
      message += ` (${user})`;
    }

    return message;
  }

  private iconStyle() {
    return {
      '--bg': `var(--bg-${kebabCase(this.props.event.type)})`,
    } as React.CSSProperties;
  }
}
