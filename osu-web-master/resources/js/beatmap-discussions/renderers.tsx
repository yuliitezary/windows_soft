// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { uriTransformer } from 'react-markdown';
import { ReactMarkdownProps } from 'react-markdown/lib/complex-types';
import { propsFromHref, timestampRegex } from 'utils/beatmapset-discussion-helper';
import { openBeatmapEditor } from 'utils/url';

export const timestampRegexGlobal = new RegExp(timestampRegex, 'g');

export function emphasisRenderer(astProps: ReactMarkdownProps & React.DetailedHTMLProps<React.HTMLAttributes<HTMLElement>, HTMLElement>) {
  return <em>{astProps.children.map(timestampDecorator)}</em>;
}

export function linkRenderer(astProps: ReactMarkdownProps & React.DetailedHTMLProps<React.AnchorHTMLAttributes<HTMLAnchorElement>, HTMLAnchorElement>) {
  // TODO: handle extra nodes in astProps.children
  const props = propsFromHref(astProps.href ?? '');

  return <a href={astProps.href} {...props} />;
}

export function paragraphRenderer(astProps: ReactMarkdownProps & React.DetailedHTMLProps<React.HTMLAttributes<HTMLParagraphElement>, HTMLParagraphElement>) {
  return <div className='beatmapset-discussion-message'>{astProps.children.map(timestampDecorator)}</div>;
}

export function strongRenderer(astProps: ReactMarkdownProps & React.DetailedHTMLProps<React.HTMLAttributes<HTMLElement>, HTMLElement>) {
  return <strong>{astProps.children.map(timestampDecorator)}</strong>;
}

function timestampDecorator(reactNode: React.ReactNode) {
  if (typeof reactNode === 'string') {
    const matches = [...reactNode.matchAll(timestampRegexGlobal)];

    if (matches.length > 0) {
      let cursor = 0;
      const nodes: React.ReactNode[] = [];

      for (const match of matches) {
        // insert any preceding text
        const index = match.index ?? 0;
        const textFragment = reactNode.substring(cursor, index);
        nodes.push(textFragment);

        // decorate the timestamp as a link
        const [,,, m, s, ms, range] = match;
        const timestamp = `${m}:${s}:${ms}${range ?? ''}`;

        nodes.push((
          <a key={`timestamp-${index}`} className='beatmap-discussion-timestamp-decoration' href={openBeatmapEditor(timestamp)}>{timestamp}</a>
        ));

        cursor = index + match[0].length;
      }

      // add any remaining text
      nodes.push(reactNode.substring(cursor, reactNode.length));

      return nodes;
    }
  }

  return reactNode;
}

export function transformLinkUri(uri: string) {
  if (uri.startsWith('osu://edit/')) {
    // TODO: sanitize timestamp?
    return uri;
  }

  return uriTransformer(uri);
}
