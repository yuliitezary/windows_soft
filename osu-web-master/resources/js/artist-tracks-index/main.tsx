// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'components/header-v4';
import ShowMoreLink from 'components/show-more-link';
import TracklistTrack from 'components/tracklist-track';
import { ArtistTrackWithArtistJson } from 'interfaces/artist-track-json';
import { route } from 'laroute';
import { action, makeObservable, observable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { onError } from 'utils/ajax';
import { classWithModifiers } from 'utils/css';
import { jsonClone } from 'utils/json';
import { trans } from 'utils/lang';
import { navigate } from 'utils/turbolinks';
import SearchForm, { ArtistTrackSearch } from './search-form';
import Sort from './sort-bar';

export interface ArtistTracksIndex {
  artist_tracks: ArtistTrackWithArtistJson[];
  cursor_string: string | null;
  search: ArtistTrackSearch;
}

interface Props {
  availableGenres: string[];
  container: HTMLElement;
  data: ArtistTracksIndex;
}

const headerLinks = [
  {
    title: trans('layout.header.artists.index'),
    url: route('artists.index'),
  },
  {
    active: true,
    title: trans('artist.tracks.index._'),
    url: route('artists.tracks.index'),
  },
];

@observer
export default class Main extends React.Component<Props> {
  @observable private data = jsonClone(this.props.data);
  @observable private isNavigating = false;
  @observable private loadingXhr?: JQuery.jqXHR<ArtistTracksIndex> | null = null;

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  componentWillUnmount() {
    this.loadingXhr?.abort();
  }

  render() {
    return (
      <>
        <HeaderV4 links={headerLinks} theme='artists' />

        <div className='osu-page osu-page--header'>
          <SearchForm
            availableGenres={this.props.availableGenres}
            initialParams={this.props.data.search}
            onNewSearch={this.onNewSearch}
          />
        </div>

        <div className='osu-page osu-page--artist-track-search-result'>
          {this.data.artist_tracks.length === 0 ? (
            <div>
              {trans('artist.tracks.index.form.empty')}
            </div>
          ) : (
            <>
              <Sort
                onNewSearch={this.onNewSearch}
                params={this.props.data.search}
              />

              <div className={classWithModifiers('grid-items', '2', { 'fade-out': this.isNavigating })}>
                {this.data.artist_tracks.map((t) => (
                  <TracklistTrack key={t.id} modifiers='large' showAlbum track={t} />
                ))}

                <ShowMoreLink
                  callback={this.handleShowMore}
                  hasMore={this.data.cursor_string != null}
                  loading={this.loadingXhr != null}
                  modifiers='centre-10'
                />
              </div>
            </>
          )}
        </div>
      </>
    );
  }

  @action
  private readonly handleShowMore = () => {
    this.loadingXhr = $.getJSON(route('artists.tracks.index'), { ...this.data.search, cursor_string: this.data.cursor_string });

    this.loadingXhr.done((newData) => runInAction(() => {
      const { container, ...prevProps } = this.props;
      newData.artist_tracks = this.data.artist_tracks.concat(newData.artist_tracks);
      this.data = newData;
      this.props.container.dataset.props = JSON.stringify({ ...prevProps, data: this.data });
    })).fail(onError).always(action(() => {
      this.loadingXhr = null;
    }));
  };

  private readonly onNewSearch = (url: string) => {
    navigate(url, true);
    this.isNavigating = true;
  };
}
