// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import NewsPostJson from 'interfaces/news-post-json';
import { route } from 'laroute';
import * as React from 'react';
import { trans } from 'utils/lang';
import HeaderV4 from './header-v4';

interface Props {
  post?: NewsPostJson;
  section: string;
  title: string;
}

export default function NewsHeader(props: Props) {
  const links = [
    {
      active: props.section === 'index',
      title: trans('news.index.title.info'),
      url: route('news.index'),
    },
  ];

  if (props.section === 'show' && props.post != null) {
    links.push({
      active: true,
      title: props.post.title,
      url: route('news.show', { news: props.post.slug }),
    });
  }

  return (
    <HeaderV4
      links={links}
      linksBreadcrumb
      theme='news'
    />
  );
}
