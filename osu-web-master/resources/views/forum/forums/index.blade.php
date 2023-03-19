{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'pageDescription' => osu_trans('forum.title'),
    'searchParams' => ['mode' => 'forum_post'],
])

@php
    $currentUserId = Auth::user()?->getKey();
@endphp
@section('content')
    @include('forum._header')

    <div class="osu-page osu-page--forum">
        @foreach($forums as $category)
            <div class="forum-list t-forum-{{ $category->categorySlug() }}" id="forum-{{ $category->getKey() }}">
                <div class="forum-list__header">
                    <div class="forum-title">
                        <h3 class="forum-title__name">{{ $category->forum_name }}</h3>
                        <p class="forum-title__description">{{ $category->forum_desc }}</p>
                    </div>

                    <div class="forum-list__buttons">
                        <div class="forum-list__button">
                            @include('forum.forums._mark_as_read', ['forum' => $category, 'recursive' => true])
                        </div>
                    </div>

                    <div class="forum-list__menu">
                        @php
                            $menuId = "forum-{$category->getKey()}";
                        @endphp
                        <button class="forum-list__menu-button js-click-menu" data-click-menu-target="{{ $menuId }}">
                            <span class="fas fa-ellipsis-v"></span>
                        </button>

                        <div
                            class="simple-menu simple-menu--forum-list js-click-menu"
                            data-visibility="hidden"
                            data-click-menu-id="{{ $menuId }}"
                        >
                            @include('forum.forums._mark_as_read', [
                                'blockClass' => 'simple-menu__item',
                                'forum' => $category,
                                'recursive' => true,
                            ])
                        </div>
                    </div>
                </div>

                <ul class="forum-list__items">
                    <li class="forum-item forum-item--header">
                        <div class="forum-item__details">
                            {{ osu_trans('forum.forums.forums') }}
                        </div>
                        <div class="forum-item__latest-post">
                            {{ osu_trans('forum.forums.latest_post') }}
                        </div>
                    </li>
                    @foreach ($category->subforums as $forum)
                        @include('forum.forums._forum', compact('currentUserId', 'forum'))
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
@endsection
