// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ProfilePageExtraSectionTitle from 'components/profile-page-extra-section-title';
import StringWithComponent from 'components/string-with-component';
import TimeWithTooltip from 'components/time-with-tooltip';
import UserLink from 'components/user-link';
import UserAccountHistoryJson from 'interfaces/user-account-history-json';
import { computed } from 'mobx';
import { observer } from 'mobx-react';
import * as moment from 'moment';
import ExtraHeader from 'profile-page/extra-header';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { stripTags } from 'utils/html';
import { trans } from 'utils/lang';
import ExtraPageProps from './extra-page-props';

const bn = 'profile-extra-recent-infringements';
const columns = ['date', 'action', 'length', 'description'] as const;
type Column = typeof columns[number];

interface ColumnProps {
  history: UserAccountHistoryJson;
}

const ColumnAction = ({ history }: ColumnProps) => (
  <div className={`${bn}__action ${bn}__action--${history.type.replace(/_/g, '-')}`}>
    {trans(`users.show.extra.account_standing.recent_infringements.actions.${history.type}`)}
  </div>
);

const ColumnDate = ({ history }: ColumnProps) => (
  <TimeWithTooltip dateTime={history.timestamp} relative />
);

const ColumnDescription = ({ history }: ColumnProps) => (
  <span className={`${bn}__description`}>
    {history.supporting_url != null
      ? <a href={history.supporting_url}>{history.description}</a>
      : history.description
    }

    {history.actor != null && (
      <span className={`${bn}__actor`}>
        <StringWithComponent
          mappings={{ username: <UserLink user={history.actor} /> }}
          pattern={trans('users.show.extra.account_standing.recent_infringements.actor')}
        />
      </span>
    )}
  </span>
);

const ColumnLength = ({ history }: ColumnProps) => {
  if (history.type === 'restriction' || history.permanent) {
    return (
      <div className={`${bn}__action ${bn}__action--restriction`}>
        {trans('users.show.extra.account_standing.recent_infringements.length_permanent')}
      </div>
    );
  }

  if (history.type === 'note') {
    return null;
  }

  return <>{moment.duration(history.length, 'seconds').humanize()}</>;
};

const content: Record<Column, (props: ColumnProps) => JSX.Element | null> = {
  action: ColumnAction,
  date: ColumnDate,
  description: ColumnDescription,
  length: ColumnLength,
};

@observer
export default class AccountStanding extends React.Component<ExtraPageProps> {
  @computed
  get endTime() {
    return this.latest == null
      ? null
      : moment(this.latest.timestamp).add(this.latest.length, 'seconds');
  }

  @computed
  get latest() {
    return this.props.controller.state.user.account_history.find((d) => d.type === 'silence');
  }

  render() {
    return (
      <div className='page-extra'>
        <ExtraHeader name={this.props.name} withEdit={false} />

        {this.latest != null && (
          <div className='page-extra__alert page-extra__alert--warning'>
            <StringWithComponent
              mappings={{ username: <strong>{this.props.controller.state.user.username}</strong> }}
              // TODO: remove stripTags once translations are updated
              pattern={stripTags(trans('users.show.extra.account_standing.bad_standing'))}
            />
          </div>
        )}

        {this.endTime != null && this.endTime.isAfter() && (
          <div className='page-extra__alert page-extra__alert--info'>
            <StringWithComponent
              mappings={{
                duration: <TimeWithTooltip dateTime={this.endTime} relative />,
                username: <strong>{this.props.controller.state.user.username}</strong>,
              }}
              // TODO: remove stripTags once translations are updated
              pattern={stripTags(trans('users.show.extra.account_standing.remaining_silence'))}
            />
          </div>
        )}

        <ProfilePageExtraSectionTitle titleKey='users.show.extra.account_standing.recent_infringements.title' />

        <div className={bn}>
          <table className={`${bn}__table`}>
            <thead>
              <tr>
                {columns.map(this.renderHeaderColumn)}
              </tr>
            </thead>
            <tbody>
              {this.props.controller.state.user.account_history.map((h) => (
                <tr key={h.id}>
                  {columns.map((column) => this.renderColumn(column, h))}
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    );
  }

  private readonly renderColumn = (column: Column, history: UserAccountHistoryJson) => (
    <td key={column} className={classWithModifiers(`${bn}__table-cell`, column)}>
      {React.createElement(content[column], { history })}
    </td>
  );

  private readonly renderHeaderColumn = (column: Column) => (
    <th key={column} className={classWithModifiers(`${bn}__table-cell`, 'header', column)}>
      {trans(`users.show.extra.account_standing.recent_infringements.${column}`)}
    </th>
  );
}
