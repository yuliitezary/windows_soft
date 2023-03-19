// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { CommentJson } from 'interfaces/comment-json';
import { computed, makeObservable } from 'mobx';
import core from 'osu-core-singleton';

export type CommentSort = 'new' | 'old' | 'top';

export class Comment {
  commentableId: number;
  commentableType: string; // TODO: type?
  createdAt: string;
  deletedAt: string | null;
  deletedById?: number | null;
  editedAt: string | null;
  editedById: number | null;
  id: number;
  legacyName: string | null;
  message?: string;
  messageHtml?: string;
  parentId: number | null;
  pinned: boolean;
  repliesCount: number;
  updatedAt: string;
  userId: number | null;
  votesCount: number;

  constructor(json: CommentJson) {
    this.commentableId = json.commentable_id;
    this.commentableType = json.commentable_type;
    this.createdAt = json.created_at;
    this.deletedAt = json.deleted_at;
    this.deletedById = json.deleted_by_id;
    this.editedAt = json.edited_at;
    this.editedById = json.edited_by_id;
    this.id = json.id;
    this.legacyName = json.legacy_name;
    this.message = json.message;
    this.messageHtml = json.message_html;
    this.parentId = json.parent_id;
    this.pinned = json.pinned;
    this.repliesCount = json.replies_count;
    this.updatedAt = json.updated_at;
    this.userId = json.user_id;
    this.votesCount = json.votes_count;

    makeObservable(this);
  }

  @computed
  get canDelete() {
    return this.canModerate || this.isOwner;
  }

  @computed
  get canEdit() {
    return this.canModerate || (this.isOwner && !this.isDeleted);
  }

  @computed
  get canHaveVote() {
    return !this.isDeleted;
  }

  @computed
  get canModerate() {
    return core.currentUser != null && (core.currentUser.is_admin || core.currentUser.is_moderator);
  }

  @computed
  get canPin() {
    if (core.currentUser == null || (this.parentId != null && !this.pinned)) {
      return false;
    }

    if (core.currentUser.is_admin) {
      return true;
    }

    if (
      this.commentableType !== 'beatmapset' ||
      (!this.pinned && core.dataStore.uiState.comments.pinnedCommentIds.length > 0)
    ) {
      return false;
    }

    if (this.canModerate) {
      return true;
    }

    if (!this.isOwner) {
      return false;
    }

    const meta = core.dataStore.commentableMetaStore.get(this.commentableType, this.commentableId);

    return meta != null && 'owner_id' in meta && meta.owner_id === core.currentUser.id;
  }

  @computed
  get canReport() {
    return core.currentUser != null && this.userId !== core.currentUser.id;
  }

  @computed
  get canRestore() {
    return this.canModerate;
  }

  @computed
  get canVote() {
    return !this.isOwner;
  }

  @computed
  get isDeleted() {
    return this.deletedAt != null;
  }

  @computed
  get isEdited() {
    return this.editedAt != null;
  }

  @computed
  get isOwner() {
    return core.currentUser != null && this.userId === core.currentUser.id;
  }
}
