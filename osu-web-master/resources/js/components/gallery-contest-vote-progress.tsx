// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { CircularProgress } from 'components/circular-progress';
import * as React from 'react';
import { trans } from 'utils/lang';

type Props = Record<string, never>;

interface State {
  maxVotes: number;
  voteCount: number;
}

export default class GalleryContestVoteProgress extends React.PureComponent<Props, State> {
  constructor(props: Props) {
    super(props);

    this.state = this.getVoteState();
  }

  componentDidMount() {
    $.subscribe('contest:vote:end', this.syncState);
  }

  componentWillUnmount() {
    $.unsubscribe('contest:vote:end', this.syncState);
  }

  render() {
    return (
      <div className='pswp__button pswp__button--vote-progress'>
        <CircularProgress
          current={this.state.voteCount}
          max={this.state.maxVotes}
          theme='gallery-contest'
          tooltip={trans('contest.voting.progress._', {
            max: this.state.maxVotes,
            used: this.state.voteCount,
          })}
        />
      </div>
    );
  }

  private getVoteState = (): State => JSON.parse(this.voteSummary().dataset.contestVoteSummary ?? '');

  private syncState = () => {
    this.setState(this.getVoteState());
  };

  private voteSummary = () => {
    const contestVoteSummary = document.querySelector('.js-contest-vote-summary');

    if (contestVoteSummary instanceof HTMLElement) {
      return contestVoteSummary;
    }

    throw new Error('.js-contest-vote-summary is not HTMLElement');
  };
}
