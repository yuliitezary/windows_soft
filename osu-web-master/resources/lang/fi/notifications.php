<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Kaikki ilmoitukset luettu!',
    'delete' => 'Poista :type',
    'loading' => 'Ladataan lukemattomia ilmoituksia...',
    'mark_read' => 'Tyhjennä :type',
    'none' => 'Ei ilmoituksia',
    'see_all' => 'näytä kaikki ilmoitukset',
    'see_channel' => 'siirry keskusteluun',
    'verifying' => 'Vahvista istuntosi nähdäksesi ilmoitukset',

    'action_type' => [
        '_' => '',
        'beatmapset' => '',
        'build' => '',
        'channel' => '',
        'forum_topic' => '',
        'news_post' => '',
        'user' => '',
    ],

    'filters' => [
        '_' => 'kaikki',
        'user' => 'profiili',
        'beatmapset' => 'beatmapit',
        'forum_topic' => 'foorumi',
        'news_post' => 'uutiset',
        'build' => '',
        'channel' => 'chat',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmappi',

            'beatmap_owner_change' => [
                '_' => '',
                'beatmap_owner_change' => '',
                'beatmap_owner_change_compact' => '',
            ],

            'beatmapset_discussion' => [
                '_' => 'Beatmap-keskustelut',
                'beatmapset_discussion_lock' => 'Keskustelu beatmapissa ":title" on lukittu',
                'beatmapset_discussion_lock_compact' => 'Keskustelu on lukittu',
                'beatmapset_discussion_post_new' => 'Uusi viesti beatmapissa ":title" käyttäjältä :username: ":content"',
                'beatmapset_discussion_post_new_empty' => 'Uusi viesti beatmapissa ":title" käyttäjältä :username',
                'beatmapset_discussion_post_new_compact' => 'Uusi viesti käyttäjältä :username: ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Uusi viesti käyttäjältä :username',
                'beatmapset_discussion_review_new' => 'Uusi arvostelu beatmapissa ":title" käyttäjältä :username sisältäen ongelmia: :problems, ehdotuksia: :suggestions, kehuja: :praises',
                'beatmapset_discussion_review_new_compact' => 'Uusi arvostelu käyttäjältä :username sisältäen ongelmia: :problems, ehdotuksia: :suggestions, kehuja: :praises',
                'beatmapset_discussion_unlock' => '',
                'beatmapset_discussion_unlock_compact' => 'Keskustelu on avattu',
            ],

            'beatmapset_problem' => [
                '_' => '',
                'beatmapset_discussion_qualified_problem' => '',
                'beatmapset_discussion_qualified_problem_empty' => '',
                'beatmapset_discussion_qualified_problem_compact' => '',
                'beatmapset_discussion_qualified_problem_compact_empty' => '',
            ],

            'beatmapset_state' => [
                '_' => '',
                'beatmapset_disqualify' => '',
                'beatmapset_disqualify_compact' => '',
                'beatmapset_love' => '',
                'beatmapset_love_compact' => '',
                'beatmapset_nominate' => '',
                'beatmapset_nominate_compact' => '',
                'beatmapset_qualify' => '',
                'beatmapset_qualify_compact' => '',
                'beatmapset_rank' => '',
                'beatmapset_rank_compact' => '',
                'beatmapset_remove_from_loved' => '',
                'beatmapset_remove_from_loved_compact' => '',
                'beatmapset_reset_nominations' => '',
                'beatmapset_reset_nominations_compact' => '',
            ],

            'comment' => [
                '_' => 'Uusi kommentti',

                'comment_new' => '',
                'comment_new_compact' => '',
                'comment_reply' => '',
                'comment_reply_compact' => '',
            ],
        ],

        'channel' => [
            '_' => 'Chat',

            'announcement' => [
                '_' => '',

                'announce' => [
                    'channel_announcement' => '',
                    'channel_announcement_compact' => ':title',
                    'channel_announcement_group' => '',
                ],
            ],

            'channel' => [
                '_' => 'Uusi viesti',

                'pm' => [
                    'channel_message' => '',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => '',
                ],
            ],
        ],

        'build' => [
            '_' => 'Muutosloki',

            'comment' => [
                '_' => 'Uusi kommentti',

                'comment_new' => '',
                'comment_new_compact' => ':username kommentoi ":content"',
                'comment_reply' => '',
                'comment_reply_compact' => '',
            ],
        ],

        'news_post' => [
            '_' => 'Uutiset',

            'comment' => [
                '_' => 'Uusi kommentti',

                'comment_new' => '',
                'comment_new_compact' => ':username kommentoi":content"',
                'comment_reply' => '',
                'comment_reply_compact' => ':username vastasi ":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'Foorumin aihe',

            'forum_topic_reply' => [
                '_' => 'Uusi foorumi vastaus',
                'forum_topic_reply' => ':username vastasi foorumi aiheeseen ":title".',
                'forum_topic_reply_compact' => ':username vastasi',
            ],
        ],

        'legacy_pm' => [
            '_' => '',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited lukematon viesti.|:count_delimited lukemattomia viestejä.',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'Uusi beatmappi',

                'user_beatmapset_new' => '',
                'user_beatmapset_new_compact' => 'Uusi beatmap ":title"',
                'user_beatmapset_new_group' => '',

                'user_beatmapset_revive' => '',
                'user_beatmapset_revive_compact' => '',
            ],
        ],

        'user_achievement' => [
            '_' => 'Mitalit',

            'user_achievement_unlock' => [
                '_' => 'Uusi mitali',
                'user_achievement_unlock' => '',
                'user_achievement_unlock_compact' => '',
                'user_achievement_unlock_group' => 'Mitaleja saavutettu!',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => '',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => '',
                'beatmapset_discussion_post_new' => '',
                'beatmapset_discussion_unlock' => '',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => '',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '',
                'beatmapset_love' => '',
                'beatmapset_nominate' => '',
                'beatmapset_qualify' => '',
                'beatmapset_rank' => '',
                'beatmapset_remove_from_loved' => '',
                'beatmapset_reset_nominations' => '',
            ],

            'comment' => [
                'comment_new' => '',
            ],
        ],

        'channel' => [
            'announcement' => [
                'announce' => '',
            ],

            'channel' => [
                'pm' => 'Olet saanut uuden viestin käyttäjältä :username',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'Muutosloki ":title" on saanut uusia kommentteja',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'Uutinen ":title" on saanut uusia kommentteja',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => '',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => '',
                'user_achievement_unlock_self' => '',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => '',
                'user_beatmapset_revive' => '',
            ],
        ],
    ],
];
