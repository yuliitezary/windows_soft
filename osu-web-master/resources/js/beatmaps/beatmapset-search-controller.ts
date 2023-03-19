// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetSearch, SearchResponse } from 'beatmaps/beatmapset-search';
import ResultSet from 'beatmaps/result-set';
import { BeatmapsetSearchFilters, FilterKey, filtersFromUrl } from 'beatmapset-search-filters';
import { route } from 'laroute';
import { debounce, intersection } from 'lodash';
import { action, computed, IObjectDidChange, Lambda, makeObservable, observable, observe, runInAction } from 'mobx';
import core from 'osu-core-singleton';
import { trans, transArray } from 'utils/lang';
import { popup } from 'utils/popup';
import { currentUrl } from 'utils/turbolinks';


const expandFilters: FilterKey[] = ['genre', 'language', 'extra', 'rank', 'played'];

export interface SearchStatus {
  error?: any;
  from: number;
  restore?: boolean;
  state: 'completed' // search not doing anything
  | 'input'        // receiving input but not searching
  | 'paging'       // getting more pages
  | 'searching'    // actually doing a search
  ;
}

export class BeatmapsetSearchController {
  @observable advancedSearch = false;
  // the list that gets displayed while new searches are loading.
  @observable currentResultSet = new ResultSet();
  @observable filters!: BeatmapsetSearchFilters;
  @observable isExpanded = false;

  @observable searchStatus: SearchStatus = {
    error: null,
    from: 0,
    state: 'completed',
  };

  private readonly debouncedFilterChangedSearch = debounce(() => this.filterChangedSearch(), 500);
  private filtersObserver!: Lambda;
  private initialErrorMessage?: string;

  constructor(private beatmapsetSearch: BeatmapsetSearch) {
    makeObservable(this);
  }

  @computed
  get currentBeatmapsetIds() {
    return [...this.currentResultSet.beatmapsetIds];
  }

  get error() {
    return this.searchStatus.error;
  }

  @computed
  get hasMore() {
    return this.currentResultSet.hasMoreForPager;
  }

  @computed
  get isBusy() {
    return this.searchStatus.state === 'searching' || this.searchStatus.state === 'input';
  }

  @computed
  get isPaging() {
    return this.searchStatus.state === 'paging';
  }

  @computed
  get isSupporterMissing() {
    return !(core.currentUser?.is_supporter ?? false) && this.filters.supporterRequired.length > 0;
  }

  @computed
  get recommendedDifficulty() {
    return this.beatmapsetSearch.recommendedDifficulties.get(this.filters.mode);
  }

  @computed
  get supporterRequiredFilterText() {
    const text = this.filters.supporterRequired.map((name) => trans(`beatmaps.listing.search.filters.${name}`));
    return transArray(text);
  }

  @action
  cancel() {
    this.debouncedFilterChangedSearch.cancel();
    this.beatmapsetSearch.cancel();
  }

  getFilters(key: FilterKey) {
    const value = this.filters.selectedValue(key);

    return value != null ? value.split('.') : value;
  }

  initialize(data: SearchResponse) {
    this.restoreStateFromUrl();
    this.beatmapsetSearch.initialize(this.filters, data);
    this.initialErrorMessage = data.error;
  }

  @action
  loadMore() {
    if (this.isBusy || !this.hasMore) {
      return;
    }

    this.search(this.currentResultSet.beatmapsetIds.size);
  }

  @action
  restoreTurbolinks() {
    this.restoreStateFromUrl();
    this.search(0, true);
    if (this.initialErrorMessage != null) {
      popup(this.initialErrorMessage, 'danger');
      delete this.initialErrorMessage;
    }
  }

  @action
  async search(from = 0, restore = false) {
    if (this.isSupporterMissing || from < 0) {
      this.searchStatus = { error: null, from, restore, state: 'completed' };
      return;
    }

    this.searchStatus = {
      from: 0,
      restore,
      state: from === 0 ? 'searching' : 'paging',
    };

    let error: any;
    try {
      await this.beatmapsetSearch.get(this.filters, from);
    } catch (searchError) {
      error = searchError.readyState !== 0 ? searchError : null;
    }

    runInAction(() => {
      this.searchStatus = { error, from, restore, state: 'completed' };
      this.currentResultSet = this.beatmapsetSearch.getResultSet(this.filters);
    });
  }

  private filterChangedHandler = (change: IObjectDidChange<BeatmapsetSearchFilters>) => {
    if (change.type === 'update' && change.oldValue === change.newValue) return;
    // FIXME: sort = null changes ignored because search triggered too early during filter update.
    if (change.type !== 'remove' && change.name === 'sort' && change.newValue == null) return;

    this.searchStatus.state = 'input';
    this.debouncedFilterChangedSearch();

    if (change.name !== 'query') {
      this.debouncedFilterChangedSearch.flush();
    }
  };

  private filterChangedSearch() {
    const url = route('beatmapsets.index', this.filters.queryParams);
    Turbolinks.controller.advanceHistory(url);

    this.search();
  }

  @action
  private restoreStateFromUrl() {
    const url = currentUrl().href;

    if (this.filtersObserver != null) {
      this.filtersObserver();
    }
    this.filters = new BeatmapsetSearchFilters(url);
    this.filtersObserver = observe(this.filters, this.filterChangedHandler);

    this.isExpanded = intersection(Object.keys(filtersFromUrl(url)), expandFilters).length > 0;
  }
}
