# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import BeatmapsOwnerEditor from 'beatmap-discussions/beatmaps-owner-editor'
import LoveBeatmapModal from 'beatmap-discussions/love-beatmap-modal'
import { Nominator } from 'beatmap-discussions/nominator'
import BigButton from 'components/big-button'
import DiscreteBar from 'components/discrete-bar'
import Modal from 'components/modal'
import StringWithComponent from 'components/string-with-component'
import TimeWithTooltip from 'components/time-with-tooltip'
import UserLink from 'components/user-link'
import { route } from 'laroute'
import * as React from 'react'
import { a, div, i, span } from 'react-dom-factories'
import { onError } from 'utils/ajax'
import { canModeratePosts, format, makeUrl, previewMessage } from 'utils/beatmapset-discussion-helper'
import { nominationsCount } from 'utils/beatmapset-helper'
import { joinComponents, trans } from 'utils/lang'
import { hideLoadingOverlay, showLoadingOverlay } from 'utils/loading-overlay'
import { pageChange } from 'utils/page-change'
import { presence } from 'utils/string'
import { wikiUrl } from 'utils/url'

el = React.createElement

bn = 'beatmap-discussion-nomination'
dateFormat = 'LL'

export class Nominations extends React.PureComponent
  constructor: (props) ->
    super props

    @xhr = {}
    @state =
      changeOwnerModal: false
      loveBeatmapModal: false


  componentDidMount: =>
    pageChange()


  componentWillUnmount: =>
    xhr?.abort() for _name, xhr of @xhr
    Timeout.clear @hypeFocusTimeout if @hypeFocusTimeout


  componentDidUpdate: =>
    pageChange()


  render: =>
    div className: bn,
      @renderChangeOwnerModal()
      @renderLoveBeatmapModal()
      div className: "#{bn}__items #{bn}__items--messages",
        div className: "#{bn}__item", @statusMessage()
        div className: "#{bn}__item", @hypeBar()
        div className: "#{bn}__item", @nominationBar()
        div className: "#{bn}__item", @disqualificationMessage()
        div className: "#{bn}__item", @nominationResetMessage()
        div className: "#{bn}__item", @discussionLockMessage()
        div className: "#{bn}__item #{bn}__item--nominators", @nominatorsList()
      div className: "#{bn}__items #{bn}__items--buttons",
        div className: "#{bn}__items-grouping",
          div className: "#{bn}__item", @feedbackButton()
          div className: "#{bn}__item", @hypeButton()
          div className: "#{bn}__item", @disqualifyButton()
          div className: "#{bn}__item",
            el Nominator,
              beatmapset: @props.beatmapset
              currentHype: @props.currentDiscussions.totalHype
              currentUser: @props.currentUser
              unresolvedIssues: @props.currentDiscussions.unresolvedIssues
              users: @props.users
        div className: "#{bn}__items-grouping",
          div className: "#{bn}__item", @discussionLockButton()
          div className: "#{bn}__item", @loveButton()
          div className: "#{bn}__item", @removeFromLovedButton()
          div className: "#{bn}__item", @deleteButton()
          div className: "#{bn}__item", @changeOwnerButton()


  # nominations = { 'current': { 'osu': 1, 'taiko': 0, ... }, 'required': { 'osu': 2, 'taiko': 2, ... }, ... };
  renderLightsForNominations: (nominations = {}) ->
    if nominations?.legacy_mode || !@isHybridMode()
      if nominations?.legacy_mode
        current = nominations.current
        required = nominations.required
      else
        mode = _.keys(this.props.beatmapset.nominations?.required)[0]
        current = nominations.current[mode]
        required = nominations.required[mode]

      el DiscreteBar,
        current: current
        modifiers: 'beatmapset-hype'
        total: required
    else
      div className: "#{bn}__discrete-bar-group",
        for own ruleset, required of nominations.required
          el DiscreteBar,
            current: nominations.current[ruleset]
            key: ruleset
            label: i(className: "fal fa-extra-mode-#{ruleset}")
            modifiers: 'beatmapset-nomination-hybrid'
            total: required


  delete: =>
    message = if @userIsOwner()
                trans('beatmaps.nominations.delete_own_confirm')
              else
                trans('beatmaps.nominations.delete_other_confirm')

    return unless confirm(message)

    showLoadingOverlay()

    @xhr.delete?.abort()

    user = @props.beatmapset.user_id
    url = route('beatmapsets.destroy', beatmapset: @props.beatmapset.id)
    params = method: 'DELETE'

    @xhr.delete = $.ajax(url, params)
      .done ->
        Turbolinks.visit route('users.show', { user })
      .fail onError
      .always hideLoadingOverlay


  discussionLock: =>
    reason = presence(prompt(trans('beatmaps.discussions.lock.prompt.lock')))

    return unless reason?

    @xhr.discussionLock?.abort()

    url = route('beatmapsets.discussion-lock', beatmapset: @props.beatmapset.id)
    params =
      method: 'POST'
      data: { reason }

    @xhr.discussionLock = $.ajax(url, params)
      .done (response) =>
        $.publish 'beatmapsetDiscussions:update', beatmapset: response
      .fail onError
      .always hideLoadingOverlay


  discussionUnlock: =>
    return unless confirm(trans('beatmaps.discussions.lock.prompt.unlock'))

    showLoadingOverlay()

    @xhr.discussionLock?.abort()

    url = route('beatmapsets.discussion-unlock', beatmapset: @props.beatmapset.id)
    params = method: 'POST'

    @xhr.discussionLock = $.ajax(url, params)
      .done (response) =>
        $.publish 'beatmapsetDiscussions:update', beatmapset: response
      .fail onError
      .always hideLoadingOverlay


  removeFromLoved: =>
    reason = presence(prompt(trans('beatmaps.nominations.remove_from_loved_prompt')))

    return unless reason?

    showLoadingOverlay()

    @xhr.removeFromLoved?.abort()

    url = route('beatmapsets.remove-from-loved', beatmapset: @props.beatmapset.id)
    params =
      method: 'DELETE'
      data: { reason }

    @xhr.removeFromLoved = $.ajax(url, params)
      .done (response) =>
        $.publish 'beatmapsetDiscussions:update', beatmapset: response
      .fail onError
      .always hideLoadingOverlay


  focusHypeInput: =>
    # switch to generalAll tab, set current filter to praises
    $.publish 'beatmapsetDiscussions:update',
      mode: 'generalAll'
      filter: 'praises'

    hypeMessage = '.js-hype--explanation'
    flashClass = 'js-flash-border--on'

    @hypeFocusTimeout = Timeout.set 0, =>
      @focusNewDiscussion =>
        # flash border of hype description to emphasize input is required
        $(hypeMessage).addClass(flashClass)
        @hypeFocusTimeout = Timeout.set 1000, =>
          $(hypeMessage).removeClass(flashClass)


  focusNewDiscussion: (callback) ->
    inputBox = $('.js-hype--input')

    inputBox.focus()

    # ensure input box is in view and focus it
    $.scrollTo inputBox, 200,
      interrupt: true
      offset: -100
      onAfter: callback


  focusNewDiscussionWithModeSwitch: =>
    # Switch to generalAll tab just in case currently in event tab
    # and thus new discussion box isn't visible.
    $.publish 'beatmapsetDiscussions:update',
      mode: 'generalAll'
      modeIf: 'events'
      callback: @focusNewDiscussion


  isHybridMode: =>
    _.keys(this.props.beatmapset.nominations?.required).length > 1


  parseEventData: (event) =>
    user = @props.users[event.user_id]
    discussion = @props.discussions[event.comment.beatmap_discussion_id]

    if discussion?
      link = a
        className: 'js-beatmap-discussion--jump'
        href: makeUrl(discussion: discussion)
        "##{discussion.id}"

      message = span dangerouslySetInnerHTML:
        __html: previewMessage(discussion.posts[0].message)
    else
      link = "##{event.comment.beatmap_discussion_id}"
      message = trans('beatmaps.nominations.reset_message_deleted')

    {user, discussion, link, message}


  resetReason: (event) =>
    if event.type == 'disqualify' && typeof event.comment != 'object'
      reason =
        if event.comment?
          span dangerouslySetInnerHTML:
            __html: format event.comment,
              modifiers: ['white']
              newlines: false
        else
          trans('beatmaps.nominations.disqualified_no_reason')

      return el StringWithComponent,
        mappings:
          reason: reason
          time_ago: el(TimeWithTooltip, dateTime: event.created_at, relative: true)
        pattern: trans 'beatmaps.nominations.disqualified_at'

    parsedEvent = @parseEventData(event)

    el StringWithComponent,
      mappings:
        discussion: parsedEvent.link
        message: parsedEvent.message
        time_ago: el(TimeWithTooltip, dateTime: event.created_at, relative: true)
        user: el(UserLink, user: parsedEvent.user)
      pattern: trans "beatmaps.nominations.reset_at.#{event.type}"


  userCanDisqualify: =>
    @props.currentUser.is_admin || @props.currentUser.is_moderator || @props.currentUser.is_full_bn


  userIsOwner: =>
    @props.currentUser? && @props.currentUser.id == @props.beatmapset.user_id


  statusMessage: =>
    switch @props.beatmapset.status
      when 'approved', 'loved', 'ranked'
        trans "beatmaps.discussions.status-messages.#{@props.beatmapset.status}",
          date: moment(@props.beatmapset.ranked_date).format(dateFormat)
      when 'graveyard'
        trans 'beatmaps.discussions.status-messages.graveyard',
          date: moment(@props.beatmapset.last_updated).format(dateFormat)
      when 'wip'
        trans 'beatmaps.discussions.status-messages.wip'
      when 'qualified'
        rankingETA = @props.beatmapset.nominations.ranking_eta
        date =
          if rankingETA?
            moment(rankingETA).format(dateFormat)
          else
            trans 'beatmaps.nominations.rank_estimate.soon'

        el StringWithComponent,
          mappings:
            date: date
            position: @props.beatmapset.nominations.ranking_queue_position
            queue: a
              href: wikiUrl('Beatmap_ranking_procedure/Ranking_queue')
              target: '_blank'
              trans 'beatmaps.nominations.rank_estimate.queue'
          pattern: trans 'beatmaps.nominations.rank_estimate._'
      else
        null


  hypeBar: =>
    return null unless @props.beatmapset.can_be_hyped

    requiredHype = @props.beatmapset.hype.required
    hypeRaw = @props.currentDiscussions.totalHype
    hype = _.min([requiredHype, hypeRaw])

    div null,
      div className: "#{bn}__header",
        span
          className: "#{bn}__title"
          trans 'beatmaps.hype.section_title'
        span {},
          "#{hypeRaw} / #{requiredHype}"
      el DiscreteBar,
        current: hype
        total: requiredHype
        modifiers: 'beatmapset-hype'


  nominationBar: =>
    requiredHype = @props.beatmapset.hype?.required
    hypeRaw = @props.currentDiscussions.totalHype
    mapCanBeNominated = @props.beatmapset.status == 'pending' && hypeRaw >= requiredHype
    mapIsQualified = @props.beatmapset.status == 'qualified'

    return null unless mapCanBeNominated || mapIsQualified

    nominations = @props.beatmapset.nominations

    div null,
      div className: "#{bn}__header",
        span
          className: "#{bn}__title"
          trans 'beatmaps.nominations.title'
        span null,
          " #{nominationsCount(nominations, 'current')} / #{nominationsCount(nominations, 'required')}"

      @renderLightsForNominations(nominations)


  disqualificationMessage: =>
    showHype = @props.beatmapset.can_be_hyped
    disqualification = @props.beatmapset.nominations.disqualification
    mapIsQualified = @props.beatmapset.status == 'qualified'

    return null unless showHype && !mapIsQualified && disqualification?

    div null, @resetReason(disqualification)


  nominationResetMessage: =>
    showHype = @props.beatmapset.can_be_hyped
    nominationReset = @props.beatmapset.nominations.nomination_reset
    mapIsQualified = @props.beatmapset.status == 'qualified'

    return null unless showHype && !mapIsQualified && nominationReset?

    div null, @resetReason(nominationReset)


  nominatorsList: =>
    return null unless @props.beatmapset.status in ['wip', 'pending', 'ranked', 'qualified']

    nominators = []
    for event in @props.events by -1
      if event.type == 'disqualify' || event.type == 'nomination_reset'
        break
      else if event.type == 'nominate'
        nominators.unshift @props.users[event.user_id]

    return null if nominators.length == 0

    span null,
      el StringWithComponent,
        mappings:
          users: joinComponents nominators.map (user) ->
            el UserLink,
              key: user.id
              user: user
        pattern: trans('beatmaps.nominations.nominated_by')


  discussionLockMessage: =>
    return null unless @props.beatmapset.discussion_locked

    lockEvent = _.findLast @props.events, type: 'discussion_lock'

    return null unless lockEvent?

    div dangerouslySetInnerHTML:
      __html: trans 'beatmapset_events.event.discussion_lock',
        text: format(lockEvent.comment.reason, newlines: false)


  feedbackButton: =>
    return null unless @props.currentUser.id? && !@userIsOwner() && !@props.beatmapset.can_be_hyped && !@props.beatmapset.discussion_locked

    el BigButton,
      icon: 'fas fa-bullhorn'
      props:
        onClick: @focusNewDiscussionWithModeSwitch
      text: trans 'beatmaps.feedback.button'


  hypeButton: =>
    return null unless @props.beatmapset.can_be_hyped && @props.currentUser.id? && !@userIsOwner()

    userAlreadyHyped = _.find(@props.currentDiscussions.byFilter.hype.generalAll, user_id: @props.currentUser.id)?

    el BigButton,
      disabled: !@props.beatmapset.current_user_attributes.can_hype
      icon: 'fas fa-bullhorn'
      props:
        onClick: @focusHypeInput
        title: @props.beatmapset.current_user_attributes?.can_hype_reason
      text: if userAlreadyHyped then trans('beatmaps.hype.button_done') else trans('beatmaps.hype.button')


  disqualifyButton: =>
    mapIsQualified = @props.beatmapset.status == 'qualified'

    return null unless mapIsQualified && @userCanDisqualify()

    el BigButton,
      icon: 'fas fa-thumbs-down'
      modifiers: 'warning'
      props:
        onClick: @focusNewDiscussionWithModeSwitch
      text: trans 'beatmaps.nominations.disqualify'


  discussionLockButton: =>
    canModerate = canModeratePosts(@props.currentUser)

    return null unless canModerate

    if @props.beatmapset.discussion_locked
      action = 'unlock'
      icon = 'fas fa-unlock'
      onClick = @discussionUnlock
    else
      action = 'lock'
      icon = 'fas fa-lock'
      onClick = @discussionLock

    el BigButton,
      icon: icon
      modifiers: 'warning'
      props: { onClick }
      text: trans "beatmaps.discussions.lock.button.#{action}"


  loveButton: =>
    return null unless @props.beatmapset.current_user_attributes?.can_love

    el BigButton,
      icon: 'fas fa-heart'
      modifiers: 'pink'
      props:
        onClick: @handleLoveBeatmapModal
      text: trans 'beatmaps.nominations.love'


  removeFromLovedButton: =>
    return null unless @props.beatmapset.current_user_attributes?.can_remove_from_loved

    el BigButton,
      icon: 'fas fa-heart-broken'
      modifiers: 'danger'
      props:
        onClick: @removeFromLoved
      text: trans 'beatmaps.nominations.remove_from_loved'


  deleteButton: =>
    return null unless @props.beatmapset.current_user_attributes?.can_delete

    el BigButton,
      icon: 'fas fa-trash'
      modifiers: 'danger'
      props:
        onClick: @delete
      text: trans 'beatmaps.nominations.delete'


  changeOwnerButton: =>
    return null unless @props.beatmapset.current_user_attributes?.can_beatmap_update_owner

    el BigButton,
      icon: 'fas fa-pen'
      props:
        onClick: @handleChangeOwnerClick
      text: trans 'beatmap_discussions.owner_editor.button'


  handleChangeOwnerClick: =>
    @setState changeOwnerModal: !@state.changeOwnerModal


  handleLoveBeatmapModal: =>
    @setState loveBeatmapModal: !@state.loveBeatmapModal


  renderChangeOwnerModal: =>
    return if !@state.changeOwnerModal

    el Modal, null,
      el BeatmapsOwnerEditor,
        beatmapset: @props.beatmapset,
        users: @props.users
        onClose: @handleChangeOwnerClick

  renderLoveBeatmapModal: =>
    return if !@state.loveBeatmapModal

    el Modal, onClose: @handleLoveBeatmapModal,
      el LoveBeatmapModal,
        beatmapset: @props.beatmapset
        onClose: @handleLoveBeatmapModal
