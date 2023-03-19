<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => 'Download now',
        'online' => '<strong>:players</strong> currently online in <strong>:games</strong> games',
        'peak' => 'Peak, :count online users',
        'players' => '<strong>:count</strong> registered players',
        'title' => 'welcome',
        'see_more_news' => 'see more news',

        'slogan' => [
            'main' => 'the bestest free-to-win rhythm game',
            'sub' => 'rhythm is just a click away',
        ],
    ],

    'search' => [
        'advanced_link' => 'Advanced search',
        'button' => 'Search',
        'empty_result' => 'Nothing found!',
        'keyword_required' => 'A search keyword is required',
        'placeholder' => 'type to search',
        'title' => 'search',

        'beatmapset' => [
            'login_required' => 'Sign in to search beatmaps',
            'more' => ':count more beatmap search results',
            'more_simple' => 'See more beatmap search results',
            'title' => 'Beatmaps',
        ],

        'forum_post' => [
            'all' => 'All forums',
            'link' => 'Search the forum',
            'login_required' => 'Sign in to search the forum',
            'more_simple' => 'See more forum search results',
            'title' => 'Forum',

            'label' => [
                'forum' => 'search in forums',
                'forum_children' => 'include subforums',
                'include_deleted' => 'include deleted posts',
                'topic_id' => 'topic #',
                'username' => 'author',
            ],
        ],

        'mode' => [
            'all' => 'all',
            'beatmapset' => 'beatmap',
            'forum_post' => 'forum',
            'user' => 'player',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'login_required' => 'Sign in to search users',
            'more' => ':count more player search results',
            'more_simple' => 'See more player search results',
            'more_hidden' => 'Player search is limited to :max players. Try refining search query.',
            'title' => 'Players',
        ],

        'wiki_page' => [
            'link' => 'Search the wiki',
            'more_simple' => 'See more wiki search results',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'action' => 'Download osu!',
        'action_lazer' => 'Download osu!(lazer)',
        'action_lazer_description' => 'the next major update to osu!',
        'action_lazer_info' => 'check this page for more information',
        'action_lazer_title' => 'try osu!(lazer)',
        'action_title' => 'download osu!',
        'for_os' => 'for :os',
        'lazer_note' => 'note: leaderboard resets apply',
        'macos-fallback' => 'macOS users',
        'mirror' => 'mirror',
        'or' => 'or',
        'os_version_or_later' => ':os_version or later',
        'other_os' => 'other platforms',
        'quick_start_guide' => 'quick start guide',
        'tagline' => "let's get<br>you started!",
        'video-guide' => 'video guide',

        'help' => [
            '_' => 'if you have a problem starting the game or registering for an account, :help_forum_link or :support_button.',
            'help_forum_link' => 'check the help forum',
            'support_button' => 'contact support',
        ],

        'os' => [
            'windows' => 'for Windows',
            'macos' => 'for macOS',
            'linux' => 'for Linux',
        ],
        'steps' => [
            'register' => [
                'title' => 'get an account',
                'description' => 'follow the prompts when starting the game to sign in or make a new account',
            ],
            'download' => [
                'title' => 'install the game',
                'description' => 'click the button above to download the installer, then run it!',
            ],
            'beatmaps' => [
                'title' => 'get beatmaps',
                'description' => [
                    '_' => ':browse the vast library of user-created beatmaps and start playing!',
                    'browse' => 'browse',
                ],
            ],
        ],
    ],

    'user' => [
        'title' => 'dashboard',
        'news' => [
            'title' => 'News',
            'error' => 'Error loading news, try refreshing the page?...',
        ],
        'header' => [
            'stats' => [
                'friends' => 'Online Friends',
                'games' => 'Games',
                'online' => 'Online Users',
            ],
        ],
        'beatmaps' => [
            'new' => 'New Ranked Beatmaps',
            'popular' => 'Popular Beatmaps',
            'by_user' => 'by :user',
        ],
        'buttons' => [
            'download' => 'Download osu!',
            'support' => 'Support osu!',
            'store' => 'osu!store',
        ],
    ],
];
