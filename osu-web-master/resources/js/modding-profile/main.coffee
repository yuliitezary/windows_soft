# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { BeatmapsContext } from 'beatmap-discussions/beatmaps-context'
import { BeatmapsetsContext } from 'beatmap-discussions/beatmapsets-context'
import { DiscussionsContext } from 'beatmap-discussions/discussions-context'
import { ReviewEditorConfigContext } from 'beatmap-discussions/review-editor-config-context'
import HeaderV4 from 'components/header-v4'
import { NotificationBanner } from 'components/notification-banner'
import ProfilePageExtraTab from 'components/profile-page-extra-tab'
import ProfileTournamentBanner from 'components/profile-tournament-banner'
import UserProfileContainer from 'components/user-profile-container'
import { deletedUser } from 'models/user'
import Kudosu from 'modding-profile/kudosu'
import core from 'osu-core-singleton'
import Badges from 'profile-page/badges'
import Cover from 'profile-page/cover'
import DetailBar from 'profile-page/detail-bar'
import headerLinks from 'profile-page/header-links'
import * as React from 'react'
import { a, button, div, i, span } from 'react-dom-factories'
import { bottomPage } from 'utils/html'
import { pageChange } from 'utils/page-change'
import { nextVal } from 'utils/seq'
import { currentUrl, currentUrlRelative } from 'utils/turbolinks'
import { updateQueryString } from 'utils/url'
import Discussions from './discussions'
import { Events } from './events'
import { Posts } from './posts'
import Stats from './stats'
import { Votes } from './votes'

el = React.createElement

pages = document.getElementsByClassName("js-switchable-mode-page--scrollspy")
pagesOffset = document.getElementsByClassName("js-switchable-mode-page--scrollspy-offset")

export class Main extends React.PureComponent
  constructor: (props) ->
    super props

    @disposers = new Set
    @eventId = "users-modding-history-index-#{nextVal()}"
    @cache = {}
    @tabs = React.createRef()
    @pages = React.createRef()
    @state = JSON.parse(props.container.dataset.profilePageState ? null)
    @restoredState = @state?

    if !@restoredState
      page = currentUrl().hash.slice(1)
      @initialPage = page if page?

      @state =
        beatmaps: props.beatmaps
        beatmapsets: props.beatmapsets
        discussions: props.discussions
        events: props.events
        user: props.user
        users: props.users
        posts: props.posts
        votes: props.votes
        profileOrder: ['events', 'discussions', 'posts', 'votes', 'kudosu']


  componentDidMount: =>
    $.subscribe "user:update.#{@eventId}", @userUpdate
    $.subscribe "profile:page:jump.#{@eventId}", @pageJump
    $.subscribe "beatmapsetDiscussions:update.#{@eventId}", @discussionUpdate
    $(document).on "ajax:success.#{@eventId}", '.js-beatmapset-discussion-update', @ujsDiscussionUpdate
    $(window).on "scroll.#{@eventId}", @pageScan

    pageChange()

    @modeScrollUrl = currentUrlRelative()

    if !@restoredState
      @disposers.add(core.reactTurbolinks.runAfterPageLoad =>
        # The scroll is a bit off on Firefox if not using timeout.
        Timeout.set 0, => @pageJump(null, @initialPage)
      )


  componentWillUnmount: =>
    $.unsubscribe ".#{@eventId}"
    $(window).off ".#{@eventId}"
    $(document).off ".#{@eventId}"

    $(window).stop()
    Timeout.clear @modeScrollTimeout
    @disposers.forEach (disposer) => disposer?()


  discussionUpdate: (_e, options) =>
    {beatmapset} = options
    return unless beatmapset?

    discussions = @state.discussions
    posts = @state.posts
    users = @state.users

    discussionIds = _.map discussions, 'id'
    postIds = _.map posts, 'id'
    userIds = _.map users, 'id'

    # Due to the entire hierarchy of discussions being sent back when a post is updated (instead of just the modified post),
    #   we need to iterate over each discussion and their posts to extract the updates we want.
    _.each beatmapset.discussions, (newDiscussion) ->
      if discussionIds.includes(newDiscussion.id)
        discussion = _.find discussions, id: newDiscussion.id
        discussions = _.reject discussions, id: newDiscussion.id
        newDiscussion = _.merge(discussion, newDiscussion)

      newDiscussion.starting_post = newDiscussion.posts[0]
      discussions.push(newDiscussion)

      _.each newDiscussion.posts, (newPost) ->
        if postIds.includes(newPost.id)
          post = _.find posts, id: newPost.id
          posts = _.reject posts, id: newPost.id
          posts.push(_.merge(post, newPost))

    _.each beatmapset.related_users, (newUser) ->
      if userIds.includes(newUser.id)
        users = _.reject users, id: newUser.id

      users.push(newUser)

    @cache.users = @cache.discussions = @cache.userDiscussions = @cache.beatmaps = @cache.beatmapsets = null
    @setState
      discussions: _.reverse(_.sortBy(discussions, (d) -> Date.parse(d.starting_post.created_at)))
      posts: _.reverse(_.sortBy(posts, (p) -> Date.parse(p.created_at)))
      users: users


  discussions: =>
    # skipped discussions
    # - not privileged (deleted discussion)
    # - deleted beatmap
    @cache.discussions ?= _ @state.discussions
                            .filter (d) -> !_.isEmpty(d)
                            .keyBy 'id'
                            .value()


  beatmaps: =>
    @cache.beatmaps ?= _.keyBy(this.state.beatmaps, 'id')


  beatmapsets: =>
    @cache.beatmapsets ?= _.keyBy(this.state.beatmapsets, 'id')


  render: =>
    profileOrder = @state.profileOrder

    el ReviewEditorConfigContext.Provider, value: @props.reviewsConfig,
      el DiscussionsContext.Provider, value: @discussions(),
        el BeatmapsetsContext.Provider, value: @beatmapsets(),
          el BeatmapsContext.Provider, value: @beatmaps(),
            el UserProfileContainer,
              user: @state.user,
              el HeaderV4,
                backgroundImage: @props.user.cover.url
                links: headerLinks(@props.user, 'modding')
                # add space for warning banner when user is blocked
                modifiers:
                  restricted: core.currentUserModel.blocks.has(@props.user.id) || @props.user.is_restricted
                theme: 'users'

              div
                className: 'osu-page osu-page--generic-compact'

                div
                  className: 'js-switchable-mode-page--scrollspy js-switchable-mode-page--page'
                  'data-page-id': 'main'
                  el Cover, user: @props.user, currentMode: @props.user.playmode, coverUrl: @props.user.cover.url
                  if !@props.user.is_bot
                    el React.Fragment, null,
                      el ProfileTournamentBanner, banner: @state.user.active_tournament_banner

                      div className: 'profile-detail',
                        el Badges, badges: @state.user.badges
                        el Stats, user: @props.user

                  el DetailBar, user: @props.user

                div
                  className: 'hidden-xs page-extra-tabs page-extra-tabs--profile-page js-switchable-mode-page--scrollspy-offset'
                  div
                    className: 'page-mode page-mode--profile-page-extra'
                    ref: @tabs
                    for m in profileOrder
                      a
                        className: 'page-mode__item'
                        key: m
                        'data-page-id': m
                        onClick: @tabClick
                        href: "##{m}"
                        el ProfilePageExtraTab,
                          page: m
                          currentPage: @state.currentPage

                div
                  className: 'user-profile-pages'
                  ref: @pages
                  @extraPage name for name in profileOrder


  extraPage: (name) =>
    {extraClass, props, component} = @extraPageParams name
    classes = 'js-switchable-mode-page--scrollspy js-switchable-mode-page--page'
    classes += " #{extraClass}" if extraClass?
    props.name = name

    @extraPages ?= {}

    div
      key: name
      'data-page-id': name
      className: classes
      ref: (el) => @extraPages[name] = el
      el component, props


  extraPageParams: (name) =>
    switch name
      when 'discussions'
        props:
          discussions: @userDiscussions()
          user: @state.user
          users: @users()
        component: Discussions

      when 'events'
        props:
          events: @state.events
          user: @state.user
          users: @users()
        component: Events

      when 'kudosu'
        props:
          expectedInitialCount: @props.perPage.recentlyReceivedKudosu
          initialKudosu: @props.extras.recentlyReceivedKudosu
          total: @state.user.kudosu.total
          userId: @state.user.id
        component: Kudosu

      when 'posts'
        props:
          posts: @state.posts
          user: @state.user
          users: @users()
        component: Posts

      when 'votes'
        props:
          votes: @state.votes
          user: @state.user
          users: @users()
        component: Votes


  pageJump: (_e, page) =>
    if page == 'main'
      @setCurrentPage null, page
      return

    target = $(@extraPages[page])

    # if invalid page is specified, scan current position
    if target.length == 0
      @pageScan()
      return

    # Don't bother scanning the current position.
    # The result will be wrong when target page is too short anyway.
    @scrolling = true
    Timeout.clear @modeScrollTimeout

    # count for the tabs height; assume pageJump always causes the header to be pinned
    # otherwise the calculation needs another phase and gets a bit messy.
    offsetTop = target.offset().top - pagesOffset[0].getBoundingClientRect().height

    $(window).stop().scrollTo core.stickyHeader.scrollOffset(offsetTop), 500,
      onAfter: =>
        # Manually set the mode to avoid confusion (wrong highlight).
        # Scrolling will obviously break it but that's unfortunate result
        # from having the scrollspy marker at middle of page.
        @setCurrentPage null, page, =>
          # Doesn't work:
          # - part of state (callback, part of mode setting)
          # - simple variable in callback
          # Both still change the switch too soon.
          @modeScrollTimeout = Timeout.set 100, => @scrolling = false


  pageScan: =>
    return if @modeScrollUrl != currentUrlRelative()

    return if @scrolling
    return if pages.length == 0

    anchorHeight = pagesOffset[0].getBoundingClientRect().height

    if bottomPage()
      @setCurrentPage null, _.last(pages).dataset.pageId
      return

    for page in pages
      pageDims = page.getBoundingClientRect()
      pageBottom = pageDims.bottom - Math.min(pageDims.height * 0.75, 200)
      continue unless pageBottom > anchorHeight

      @setCurrentPage null, page.dataset.pageId
      return

    @setCurrentPage null, page.dataset.pageId


  setCurrentPage: (_e, page, extraCallback) =>
    callback = =>
      extraCallback?()

    if @state.currentPage == page
      return callback()

    @setState currentPage: page, callback


  tabClick: (e) =>
    e.preventDefault()

    @pageJump null, e.currentTarget.dataset.pageId


  userUpdate: (_e, user) =>
    return @forceUpdate() if user?.id != @state.user.id

    # this component needs full user object but sometimes this event only sends part of it
    @setState user: _.assign({}, @state.user, user)


  users: =>
    if !@cache.users?
      @cache.users = _.keyBy @state.users, 'id'
      @cache.users[null] = @cache.users[undefined] = deletedUser.toJson()

    @cache.users

  userDiscussions: =>
    if !@cache.userDiscussions
      @cache.userDiscussions = _.filter @state.discussions, (d) => d.user_id == @state.user.id

    @cache.userDiscussions


  ujsDiscussionUpdate: (_e, data) =>
    # to allow ajax:complete to be run
    Timeout.set 0, => @discussionUpdate(null, beatmapset: data)
