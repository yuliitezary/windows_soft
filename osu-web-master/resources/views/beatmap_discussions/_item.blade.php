{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $postTypeToIcon = [
      'hype' => 'fas fa-bullhorn',
      'mapper_note' => 'far fa-sticky-note',
      'praise' => 'fas fa-heart',
      'problem' => 'fas fa-exclamation-circle',
      'review' => 'fas fa-tasks',
      'suggestion' => 'far fa-circle',
    ];
@endphp
<div class="beatmap-discussions__discussion beatmapset-activities__discussion-post">
    <div class="beatmap-discussion beatmap-discussion--single beatmapset-activities__post-grow{{ $discussion->trashed() ? ' beatmap-discussion--deleted' : ''}}">
        <div class="beatmap-discussion-timestamp__icons-container">
            <div class="beatmap-discussion-timestamp__icons">
                <a class="link link--no-underline" href="{{ route('beatmapsets.discussion', $discussion->beatmapset) }}#/{{ $discussion->getKey() }}">
                    @include('objects._beatmapset_cover', [
                        'beatmapset' => $discussion->beatmapset,
                        'modifiers' => null,
                        'size' => 'list',
                    ])
                </a>
                <div class="beatmap-discussion-timestamp__icon beatmapset-activities__timeline-icon-margin">
                    <span
                        class="{{ $postTypeToIcon[$discussion->message_type] }}"
                        style="color: var(--beatmapset-discussion-colour--{{ $discussion->message_type }})"
                        title="{{ osu_trans("beatmaps.discussions.message_type.{$discussion->message_type}") }}"
                    ></span>
                </div>
            </div>
        </div>
        <div class="beatmap-discussion__discussion">
            <div class="beatmap-discussion__top">
                <div class="beatmap-discussion-post beatmap-discussion-post--discussion">
                    <div class="beatmap-discussion-post__content">
                        @include('beatmapset_activities._user', ['user' => $discussion->user])

                        <div class="beatmap-discussion-post__message-container">
                            <div class="beatmap-discussion-post__message">{{$discussion->startingPost->message}}</div>
                            <div class="beatmap-discussion-post__info-container">
                                <span class="beatmap-discussion-post__info">{!! timeago($discussion->created_at) !!}</span>
                                @if ($discussion->deleted_at !== null)
                                    <span class="beatmap-discussion-post__info">
                                        {{ osu_trans('beatmap_discussions.item.deleted_at') }}: {!! timeago($discussion->deleted_at) !!}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($discussion->resolved)
                <div class="beatmap-discussion__line beatmap-discussion__line--resolved"></div>
            @endif
        </div>
    </div>
</div>
