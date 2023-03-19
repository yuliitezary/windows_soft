<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => 'Letöltés',
        'online' => 'Jelenleg <strong>:players</strong> játszik <strong>:games</strong> játékban',
        'peak' => 'Csúcsfokon, :count játékos volt elérhető',
        'players' => '<strong>:count</strong> regisztrált játékos',
        'title' => 'üdv',
        'see_more_news' => 'további hírek',

        'slogan' => [
            'main' => 'a legeslegjobb ingyen játszható ritmusjáték',
            'sub' => 'a ritmus csak egy kattintásra van',
        ],
    ],

    'search' => [
        'advanced_link' => 'Részletes keresés',
        'button' => 'Keresés',
        'empty_result' => 'Nincs találat!',
        'keyword_required' => 'Adj meg egy kulcsszót is',
        'placeholder' => 'keresendő szöveg',
        'title' => 'Keresés',

        'beatmapset' => [
            'login_required' => 'Beatmapek kereséséhez jelentkezz be',
            'more' => ':count talált beatmap',
            'more_simple' => 'Több beatmap keresése',
            'title' => 'Beatmapek',
        ],

        'forum_post' => [
            'all' => 'Összes forum',
            'link' => 'Forum keresése',
            'login_required' => 'Jelentkezz be, hogy keresni tudj a fórumon',
            'more_simple' => 'Több forum keresése',
            'title' => 'Forum',

            'label' => [
                'forum' => 'forumokban keresés',
                'forum_children' => 'alforumok tartalmazása',
                'include_deleted' => 'törölt hozzászólásokat tartalmaz',
                'topic_id' => 'témák #',
                'username' => 'szerző',
            ],
        ],

        'mode' => [
            'all' => 'mind',
            'beatmapset' => 'beatmap',
            'forum_post' => 'fórum',
            'user' => 'játékos',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'login_required' => 'Jelentkezz be, hogy felhasználokat tudj keresni',
            'more' => ':count talált játékos',
            'more_simple' => 'Több játékos mutatása keresésben',
            'more_hidden' => 'Játékos kereső limitálva van :max játékosra. Próbálj pontosabb lenni.',
            'title' => 'Játékosok',
        ],

        'wiki_page' => [
            'link' => 'Wikin keresés',
            'more_simple' => 'Több wiki keresési eredmény megtekintése',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'action' => 'osu! letöltése',
        'action_lazer' => 'Töltsd le osu!(lazer)-t',
        'action_lazer_description' => 'az új nagy frissítése osu!-nak',
        'action_lazer_info' => 'lásd ezt az oldalt több információért',
        'action_lazer_title' => 'próbáld ki osu!lazer-t',
        'action_title' => 'osu! letöltése',
        'for_os' => ':os operációs rendszerhez',
        'lazer_note' => 'megjegyzés: ranglista visszaállítások történnek',
        'macos-fallback' => 'macOS használók',
        'mirror' => 'tükör',
        'or' => 'vagy',
        'os_version_or_later' => ':os_version vagy újabb',
        'other_os' => 'egyéb platoformok',
        'quick_start_guide' => 'gyors útmutató',
        'tagline' => "vágjunk<br>bele!",
        'video-guide' => 'videó útmutató',

        'help' => [
            '_' => 'ha meccs indításakor vagy fiók létrehozásánál problémába ütközöl, :help_forum_link vagy :support_button.',
            'help_forum_link' => 'segítő fórum megtekintése',
            'support_button' => 'kapcsolatfelvétel',
        ],

        'os' => [
            'windows' => 'Windows rendszerre',
            'macos' => 'macOS rendszerre',
            'linux' => 'Linux rendszerre',
        ],
        'steps' => [
            'register' => [
                'title' => 'hozz létre fiókot',
                'description' => 'kövesd a játék indításakor felugró utasításokat belépéshez vagy regisztráláshoz',
            ],
            'download' => [
                'title' => 'játék letöltése',
                'description' => 'nyomd meg a fenti gombot a telepítő letöltéséhez, majd indítsd el!',
            ],
            'beatmaps' => [
                'title' => 'beatmapek beszerzése',
                'description' => [
                    '_' => ':browse felhasználók által létrehozott hatalmas beatmap könyvtárban és kezd játszani!',
                    'browse' => 'böngéssz',
                ],
            ],
        ],
    ],

    'user' => [
        'title' => 'áttekintő',
        'news' => [
            'title' => 'Hírek',
            'error' => 'Hiba a hírek betöltése közben, talán próbáld meg újratölteni az oldalt?...',
        ],
        'header' => [
            'stats' => [
                'friends' => 'Elérhető barátok',
                'games' => 'Játékok',
                'online' => 'Elérhető felhasználók',
            ],
        ],
        'beatmaps' => [
            'new' => 'Új rangsorolt beatmapek',
            'popular' => 'Népszerű beatmapek',
            'by_user' => ':user által',
        ],
        'buttons' => [
            'download' => 'osu! letöltése',
            'support' => 'osu! támogatása',
            'store' => 'osu!bolt',
        ],
    ],
];
