// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { dispatch, dispatcher } from 'app-dispatcher';
import { NotificationBundleJson } from 'interfaces/notification-json';
import NotificationController from 'notifications/notification-controller';
import { NotificationEventMoreLoaded } from 'notifications/notification-events';
import { toJson } from 'notifications/notification-identity';
import NotificationStore from 'stores/notification-store';
import { makeNotificationJson, makeStackJson } from './helpers';

const identities = [
  {
    category: 'beatmapset_discussion',
    id: 1002,
    objectId: 2,
    objectType: 'beatmapset',
  },
  {
    category: 'beatmapset_discussion',
    id: 1001,
    objectId: 1,
    objectType: 'beatmapset',
  },
];

describe('Notification Widget', () => {
  beforeEach(() => dispatcher.clear());
  afterEach(() => dispatcher.clear());

  const bundle: NotificationBundleJson = {
    notifications: [identities[0]].map(toJson).map(makeNotificationJson),
    stacks: [makeStackJson(identities[0], 5, 'beatmapset_discussion_post_new', identities[0].id )],
    timestamp: new Date().toJSON(),
    types: [
      { cursor: { id: identities[0].id }, name: null,  total: 20 },
      { cursor: { id: identities[0].id }, name: 'beatmapset', total: 5 },
    ],
  };

  let store!: NotificationStore;
  let controller!: NotificationController;
  beforeEach(() => {
    store = new NotificationStore();
    store.unreadStacks.updateWithBundle(bundle);

    controller = new NotificationController(store, { excludes: [], isWidget: true }, null);
  });

  it('should filter by All', () => {
    expect(controller.currentFilter).toBe(null);
  });

  it('should have 1 notification', () => {
    expect(store.notifications.size).toBe(1);
  });

  it('should have 1 stack', () => {
    expect([...controller.stacks].length).toBe(1);
  });

  describe('after loading more', () => {
    beforeEach(() => {
      const loadMoreBundle: NotificationBundleJson = {
        notifications: [identities[1]].map(toJson).map(makeNotificationJson),
        stacks: [makeStackJson(identities[1], 5, 'beatmapset_discussion_post_new', identities[1].id )],
        timestamp: new Date().toJSON(),
        types: [
          { cursor: { id: identities[1].id }, name: null,  total: 20 },
          { cursor: { id: identities[1].id }, name: 'beatmapset', total: 5 },
        ],
      };

      dispatch(new NotificationEventMoreLoaded(loadMoreBundle, { isWidget: true }));
    });

    it('should have 2 notifications', () => {
      expect(store.notifications.size).toBe(2);
    });

    it('should have 2 stacks', () => {
      expect([...controller.stacks].length).toBe(2);
    });

    describe('change filter to Beatmapsets', () => {
      beforeEach(() => {
        controller.navigateTo('beatmapset');
      });

      it('should filter by Beatmapsets', () => {
        expect(controller.currentFilter).toBe('beatmapset');
      });

      it('should contain the extra notifications', () => {
        expect([...controller.stacks].length).toBe(2);
      });
    });
  });

  describe('when changing filter', () => {
    let previousUrl!: string;
    beforeEach(() => {
      previousUrl = location.href;
      controller.navigateTo('beatmapset');
    });

    it('should not change the url', () => {
      expect(location.href).toBe(previousUrl);
    });
  });
});
