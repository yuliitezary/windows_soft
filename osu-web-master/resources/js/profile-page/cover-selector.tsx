// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { times } from 'lodash';
import { action, observable, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import { nextVal } from 'utils/seq';
import Controller from './controller';
import CoverSelection from './cover-selection';
import CoverUploader from './cover-uploader';

type DropOverlayState = 'hover' | undefined;
type DropOverlayVisibility = 'hidden' | undefined;

const coverIndexes = times(8, (i) => (i + 1).toString());

interface Props {
  controller: Controller;
}

@observer
export default class CoverSelector extends React.Component<Props> {
  @observable private dropOverlayState: DropOverlayState;
  @observable private dropOverlayVisibility: DropOverlayVisibility = 'hidden';
  private readonly dropzoneRef = React.createRef<HTMLDivElement>();
  private readonly eventId = `users-show-cover-selector-${nextVal()}`;
  private readonly uploaderRef = React.createRef<CoverUploader>();

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  componentDidMount() {
    this.uploaderRef.current?.setup();
    $.subscribe(`dragenterGlobal.${this.eventId}`, this.dropOverlayStart);
    $.subscribe(`dragendGlobal.${this.eventId}`, this.dropOverlayEnd);
  }

  componentWillUnmount() {
    this.uploaderRef.current?.destroy();
    $.unsubscribe(`.${this.eventId}`);
  }

  render() {
    return (
      <div ref={this.dropzoneRef} className='profile-cover-change-popup'>
        <div className='profile-cover-change-popup__defaults'>
          {coverIndexes.map((i) =>
            (<div key={i} className='profile-cover-change-popup__selection'>
              <CoverSelection
                controller={this.props.controller}
                isSelected={this.props.controller.state.user.cover.id === i}
                name={i}
                thumbUrl={`/images/headers/profile-covers/c${i}t.jpg`}
                url={`/images/headers/profile-covers/c${i}.jpg`}
              />
            </div>),
          )}
          <p className='profile-cover-change-popup__selections-info'>
            {trans('users.show.edit.cover.defaults_info')}
          </p>
        </div>
        <CoverUploader
          ref={this.uploaderRef}
          controller={this.props.controller}
          dropzoneRef={this.dropzoneRef}
        />
        {this.props.controller.canUploadCover &&
          <div
            className={classWithModifiers('profile-cover-change-popup__drop-overlay', this.dropOverlayState)}
            data-visibility={this.dropOverlayVisibility}
            onDragEnter={this.dropOverlayEnter}
            onDragLeave={this.dropOverlayLeave}
          >
            {trans('users.show.edit.cover.upload.dropzone')}
          </div>
        }
      </div>
    );
  }

  @action
  private readonly dropOverlayEnd = () => {
    this.dropOverlayVisibility = 'hidden';
  };

  @action
  private readonly dropOverlayEnter = () => {
    this.dropOverlayState = 'hover';
  };

  @action
  private readonly dropOverlayLeave = () => {
    this.dropOverlayState = undefined;
  };

  @action
  private readonly dropOverlayStart = () => {
    this.dropOverlayVisibility = undefined;
  };
}
