<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => '今すぐダウンロード',
        'online' => '現在<strong>:players</strong>人オンラインでマルチ部屋数<strong>:games</strong>',
        'peak' => '最高オンライン数:count人',
        'players' => '累計登録者数<strong>:count</strong>人',
        'title' => 'ようこそ！',
        'see_more_news' => '他のニュースを見る',

        'slogan' => [
            'main' => '基本料無料で最高のリズムゲーム',
            'sub' => 'リズムはもう、その指先に',
        ],
    ],

    'search' => [
        'advanced_link' => '高度な検索',
        'button' => '検索',
        'empty_result' => '何も見つかりませんでした！',
        'keyword_required' => '検索キーワードが必要です',
        'placeholder' => '検索キーワードを入力',
        'title' => '検索',

        'beatmapset' => [
            'login_required' => 'ログインしてビートマップを検索',
            'more' => '他:count件のビートマップ検索結果',
            'more_simple' => 'もっとビートマップの検索結果を見る',
            'title' => 'ビートマップ',
        ],

        'forum_post' => [
            'all' => '全てのフォーラム',
            'link' => 'フォーラムを検索',
            'login_required' => 'ログインしてフォーラムを検索',
            'more_simple' => 'もっとフォーラム検索結果を見る',
            'title' => 'フォーラム',

            'label' => [
                'forum' => 'フォーラム内を検索',
                'forum_children' => 'サブフォーラムを含む',
                'include_deleted' => '',
                'topic_id' => 'トピック #',
                'username' => '投稿者',
            ],
        ],

        'mode' => [
            'all' => '全て',
            'beatmapset' => 'ビートマップ',
            'forum_post' => 'フォーラム',
            'user' => 'プレイヤー',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'login_required' => 'ログインしてユーザーを検索',
            'more' => '他に:count人のプレイヤーが見つかりました',
            'more_simple' => 'もっとプレイヤーの検索結果を見る',
            'more_hidden' => 'プレイヤー検索は最大:max件までです。絞り込む事をおすすめします。',
            'title' => 'プレイヤー',
        ],

        'wiki_page' => [
            'link' => 'wikiを検索',
            'more_simple' => 'もっとwikiの検索結果を見る',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'action' => 'osu!をダウンロード',
        'action_lazer' => 'osu!(lazer)をダウンロード',
        'action_lazer_description' => '次の大規模アップデート',
        'action_lazer_info' => '詳細はこちらのページをご覧ください',
        'action_lazer_title' => 'osu!(lazer)を試す',
        'action_title' => 'osu!をダウンロード',
        'for_os' => ':os 版',
        'lazer_note' => '注意: リーダーボードのリセットが適用されます',
        'macos-fallback' => 'macOSユーザー',
        'mirror' => 'ミラー',
        'or' => 'または',
        'os_version_or_later' => '',
        'other_os' => '他のプラットフォーム',
        'quick_start_guide' => 'クイックスタートガイド',
        'tagline' => "さぁ、<br>始めよう！",
        'video-guide' => '説明動画',

        'help' => [
            '_' => 'ゲームの開始やアカウント登録に問題がある場合は、:help_forum_link または :support_button。',
            'help_forum_link' => 'ヘルプフォーラムを確認する',
            'support_button' => 'お問い合わせ',
        ],

        'os' => [
            'windows' => 'for Windows',
            'macos' => 'for macOS',
            'linux' => 'for Linux',
        ],
        'steps' => [
            'register' => [
                'title' => 'アカウントを作る',
                'description' => 'ゲーム起動後に表示される手順に沿ってアカウントを作成、そしてログインしよう',
            ],
            'download' => [
                'title' => 'ゲームをインストール',
                'description' => '上のボタンからインストーラーをダウンロードして、実行しよう！',
            ],
            'beatmaps' => [
                'title' => 'ビートマップを取得',
                'description' => [
                    '_' => ':browseからユーザーが作った膨大な数のビートマップから好きなビートマップを見つけて遊ぼう！',
                    'browse' => 'ここ',
                ],
            ],
        ],
    ],

    'user' => [
        'title' => 'ダッシュボード',
        'news' => [
            'title' => 'お知らせ',
            'error' => '読み込みに失敗しました。ページの更新をしてみると直るかも・・・？',
        ],
        'header' => [
            'stats' => [
                'friends' => 'オンラインのフレンド',
                'games' => '部屋数',
                'online' => 'オンラインのユーザー数',
            ],
        ],
        'beatmaps' => [
            'new' => '最新のRankedビートマップ',
            'popular' => '人気のビートマップ',
            'by_user' => 'by :user',
        ],
        'buttons' => [
            'download' => 'osu!をダウンロード',
            'support' => 'osu!を支援する',
            'store' => 'osu!ストア',
        ],
    ],
];
