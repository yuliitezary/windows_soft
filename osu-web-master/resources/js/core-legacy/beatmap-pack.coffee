# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute'
import { onError } from 'utils/ajax'

export default class BeatmapPack
  @initialize: ->
    new BeatmapPack(elem) for elem in document.querySelectorAll('.js-beatmap-pack')

  constructor: (rootElement) ->
    @el = rootElement
    @packTag = rootElement.dataset.packTag
    @packBody = @el.querySelector('.js-accordion__item-body')
    @expander = @el.querySelector('.js-accordion__item-header')
    @busy = false
    @isCurrent = @el.classList.contains('js-accordion__item--expanded')

    $('.js-accordion').on 'beatmappack:clicked', @onClick
    $(@expander).on 'click', (event) =>
      event.preventDefault()
      $(@el).trigger 'beatmappack:clicked', @packTag

  onClick: (e, tag) =>
    e.stopPropagation()
    if @isCurrent || @packTag != tag
      @close()
    else
      @open()

  open: =>
    @isCurrent = true
    return if @busy

    @nextFrame =>
      $(@el).addClass('js-accordion__item--expanded')

    if @packBody.innerHTML?.length
      @slideDown() if @isCurrent
    else
      @busy = true
      @getBeatmapPackItem(@packTag)
      .done (data) =>
        @nextFrame =>
          @packBody.innerHTML = data
          @slideDown() if @isCurrent

      .fail onError

      .always =>
        @busy = false

  close: =>
    return if !@isCurrent
    @isCurrent = false

    @nextFrame =>
      @packBody.style.height = '0'
      $(@el).removeClass('js-accordion__item--expanded')

  # TODO: move out.
  getBeatmapPackItem: (packTag) ->
    $.get route('packs.show', pack: packTag, format: 'raw')

  slideDown: =>
    @packBody.style.height = ''
    rect = @packBody.getBoundingClientRect()
    @packBody.style.height = '0'
    @nextFrame =>
      @packBody.style.height = "#{rect.height}px"

  nextFrame: (fn) ->
    window.requestAnimationFrame fn
