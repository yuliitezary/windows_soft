// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export interface DocumentBlock {
  text: string;
  type: 'paragraph' | 'embed';
}

export interface DocumentParagraph extends DocumentBlock {
  type: 'paragraph';
}

export interface PersistedDocumentIssueEmbed {
  discussion_id: number;
  type: 'embed';
}

export interface NewDocumentIssueEmbed extends DocumentBlock {
  beatmap_id: number | null;
  discussion_type: BeatmapReviewDiscussionType;
  timestamp: number | null;
  type: 'embed';
}

export const beatmapReviewDiscussionTypes = ['praise', 'problem', 'suggestion'] as const;

export type DocumentIssueEmbed = NewDocumentIssueEmbed | PersistedDocumentIssueEmbed;
export type BeatmapReviewDiscussionType = (typeof beatmapReviewDiscussionTypes)[number];
export type BeatmapReviewBlock = DocumentIssueEmbed | DocumentParagraph;
export type BeatmapDiscussionReview = BeatmapReviewBlock[];
export type PersistedBeatmapReviewBlock = DocumentParagraph | PersistedDocumentIssueEmbed;
export type PersistedBeatmapDiscussionReview = PersistedBeatmapReviewBlock[];

export function isBeatmapReviewDiscussionType(type: string): type is BeatmapReviewDiscussionType {
  return (beatmapReviewDiscussionTypes as Readonly<string[]>).includes(type);
}
