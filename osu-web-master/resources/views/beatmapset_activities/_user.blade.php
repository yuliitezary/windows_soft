{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    // this is pretty much a php conversion of beatmap-discussions/user-card.coffee
    $bn = 'beatmap-discussion-user-card';
    $userGroup = $user->userGroupsForBadges()->first();
    $hideStripe = $hideStripe ?? false;
@endphp

<div class="{{$bn}}" style="{!! css_group_colour(optional($userGroup)->group) !!}">
    <div class="{{$bn}}__avatar">
        @if (isset($user))
            <a class="{{$bn}}__user-link" href="{{route('users.show', $user)}}">
                <span class="avatar avatar--full-rounded" style="background-image: url({{$user->user_avatar}})"></span>
            </a>
        @else
            <span class="{{$bn}}__user-link">
                <span class="avatar avatar--full-rounded avatar--guest"></span>
            </span>
        @endif
    </div>
    <div class="{{$bn}}__user">
        <div class="{{$bn}}__user-row">
            @if (isset($user))
                <a class="{{$bn}}__user-link" href="{{route('users.show', $user)}}">
                    <span class="u-ellipsis-overflow">{{$user->username}}</span>
                </a>
                @if (!$user->isBot())
                    <a class="{{$bn}}__user-modding-history-link" href="{{route('users.modding.index', $user)}}" title="{{osu_trans('beatmap_discussion_posts.item.modding_history_link')}}">
                        <i class='fas fa-align-left'></i>
                    </a>
                @endif
            @else
                <span class="{{$bn}}__user-link">
                    <span class="u-ellipsis-overflow">{{ osu_trans('users.deleted') }}</span>
                </span>
            @endif
        </div>
        <div class="{{$bn}}__user-badge">
            @if ($userGroup !== null)
                @include('objects._user_group_badge', compact('userGroup'))
            @endif
        </div>
    </div>
    @if (!$hideStripe)
        <div class="{{$bn}}__user-stripe"></div>
    @endif
</div>
