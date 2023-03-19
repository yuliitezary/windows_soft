// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { DiscussionsContext } from 'beatmap-discussions/discussions-context';
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import UserJson from 'interfaces/user-json';
import core from 'osu-core-singleton';
import * as React from 'react';
import { downloadLimited } from 'utils/beatmapset-helper';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import Editor from './editor';

interface Props {
  beatmaps: BeatmapExtendedJson[];
  beatmapset: BeatmapsetExtendedJson;
  currentBeatmap: BeatmapExtendedJson;
  currentUser: UserJson;
  pinned?: boolean;
  setPinned?: (sticky: boolean) => void;
  stickTo?: React.RefObject<HTMLDivElement>;
}

interface State {
  cssTop: string | number | undefined;
}

export default class NewReview extends React.Component<Props, State> {

  constructor(props: Props) {
    super(props);

    this.state = {
      cssTop: undefined,
    };
  }

  componentDidMount(): void {
    this.setTop();
    $(window).on('resize', this.setTop);
  }

  componentWillUnmount(): void {
    $(window).off('resize', this.setTop);
  }

  cssTop = (sticky: boolean) => {
    if (!sticky || !this.props.stickTo?.current) {
      return;
    }

    return core.stickyHeader.headerHeight + this.props.stickTo?.current?.getBoundingClientRect().height;
  };

  onFocus = () => this.setSticky(true);

  render(): React.ReactNode {
    const floatClass = 'beatmap-discussion-new-float';
    const floatMods = [];
    if (this.props.pinned) {
      floatMods.push('pinned');
    }
    let buttonCssClasses = 'btn-circle';
    if (this.props.pinned) {
      buttonCssClasses += ' btn-circle--activated';
    }

    return (
      <div className={classWithModifiers(floatClass, floatMods)} style={{ top: this.state.cssTop }}>
        <div className={`${floatClass}__floatable ${floatClass}__floatable--pinned`}>
          <div className={`${floatClass}__content`}>
            <div className='osu-page osu-page--small'>
              <div className='beatmap-discussion-new'>
                <div className='page-title'>
                  {trans('beatmaps.discussions.review.new')}
                  <span className='page-title__button'>
                    <span
                      className={buttonCssClasses}
                      onClick={this.toggleSticky}
                      title={trans(`beatmaps.discussions.new.${this.props.pinned ? 'unpin' : 'pin'}`)}
                    >
                      <span className='btn-circle__content'><i className='fas fa-thumbtack' /></span>
                    </span>
                  </span>
                </div>
                {
                  this.props.currentUser.id ? (
                    !downloadLimited(this.props.beatmapset) ? (
                      <DiscussionsContext.Consumer>
                        {
                          (discussions) => (<Editor
                            beatmaps={this.props.beatmaps}
                            beatmapset={this.props.beatmapset}
                            currentBeatmap={this.props.currentBeatmap}
                            discussions={discussions}
                            onFocus={this.onFocus}
                          />)
                        }
                      </DiscussionsContext.Consumer>
                    ) : <div className='beatmap-discussion-new__login-required'>{trans('beatmaps.discussions.message_placeholder_locked')}</div>
                  ) : <div className='beatmap-discussion-new__login-required'>{trans('beatmaps.discussions.require-login')}</div>
                }
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }

  // TODO: remove sticky when converting to mobx, like in new-discussion.
  setSticky = (sticky = true) => {
    this.setState({
      cssTop: this.cssTop(sticky),
    });

    if (this.props.setPinned) {
      this.props.setPinned(sticky);
    }
  };

  setTop = () => {
    this.setState({
      cssTop: this.cssTop(this.props.pinned ?? false),
    });
  };

  toggleSticky = () => {
    this.setSticky(!this.props.pinned);
  };
}
