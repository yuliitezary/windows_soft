// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import Modal from 'components/modal';
import { action, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import { ClientDetails } from 'oauth/client-details';
import { NewClient } from 'oauth/new-client';
import { OwnClient } from 'oauth/own-client';
import core from 'osu-core-singleton';
import * as React from 'react';
import { trans } from 'utils/lang';

const store = core.dataStore.ownClientStore;
const uiState = core.dataStore.uiState;

@observer
export class OwnClients extends React.Component {
  constructor(props: Record<string, never>) {
    super(props);

    makeObservable(this);
  }

  @action
  handleModalClose = () => {
    uiState.account.client = null;
    uiState.account.newClientVisible = false;
  };

  @action
  handleNewClientClicked = () => {
    uiState.account.newClientVisible = true;
  };

  render() {
    return (
      <>
        <div className='oauth-clients'>
          {store.clients.size > 0 ? this.renderClients() : this.renderEmpty()}
        </div>
        <BigButton
          icon='fas fa-plus'
          props={{
            id: 'new-oauth-application',
            onClick: this.handleNewClientClicked,
          }}
          text={trans('oauth.own_clients.new')}
        />

        {this.renderModaledComponents()}
      </>
    );
  }

  renderClients() {
    return [...store.clients.values()].map((client) => (
      <div key={client.id} className='oauth-clients__client'>
        <OwnClient client={client} />
      </div>
    ));
  }

  renderEmpty() {
    return <div className='oauth-clients__client'>{trans('oauth.own_clients.none')}</div>;
  }

  renderModaledComponents() {
    let component: React.ReactElement;
    if (uiState.account.newClientVisible) {
      component = <NewClient />;
    } else if (uiState.account.client != null) {
      component = <ClientDetails client={uiState.account.client} />;
    } else {
      return null;
    }

    return (
      <Modal onClose={this.handleModalClose}>
        {component}
      </Modal>
    );
  }
}
