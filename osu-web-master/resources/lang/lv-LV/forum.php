<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'Piespraustās Tēmas',
    'slogan' => "ir bīstami spēlēt vienam.",
    'subforums' => 'Subforums',
    'title' => 'Forums',

    'covers' => [
        'edit' => 'Rediģēt Pārklājumu',

        'create' => [
            '_' => 'Uzstādīt pārklājuma bildi',
            'button' => 'Augšuplādēt attēlu',
            'info' => 'Pārklājuma izmēram būtu jābūt ap :dimensions. Tu vari arī nomest bildi šeit, lai augšupielādētu.',
        ],

        'destroy' => [
            '_' => 'Noņemt pārklājumu',
            'confirm' => 'Vai tiešām esi pārliecināts, ka vēlies noņemt pārklājuma bildi?',
        ],
    ],

    'forums' => [
        'forums' => '',
        'latest_post' => 'Beidzamais Raksts',

        'index' => [
            'title' => 'Foruma Indekss',
        ],

        'topics' => [
            'empty' => 'Nav tēmu!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Atzīmēt forumu kā lasītu',
        'forums' => 'Atzīmēt forumus kā lasītus',
        'busy' => 'Atzīmēt kā lasītu...',
    ],

    'post' => [
        'confirm_destroy' => 'Vai tiešām izdzēst rakstu?',
        'confirm_restore' => 'Vai tiešām atjaunot rakstu?',
        'edited' => 'Beidzamo reizi rediģēts pēc :user :when, rediģējot :count reizes kopumā.',
        'posted_at' => 'publicēts :when',
        'posted_by_in' => '',

        'actions' => [
            'destroy' => 'Izdzēst rakstu',
            'edit' => 'Rediģēt rakstu',
            'report' => 'Ziņot rakstu',
            'restore' => 'Atjaunot rakstu',
        ],

        'create' => [
            'title' => [
                'reply' => 'Jauna atbilde',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited raksts|:count_delimited raksti',
            'topic_starter' => 'Tēmas Sāknētājs',
        ],
    ],

    'search' => [
        'go_to_post' => 'Dodies uz rakstu',
        'post_number_input' => 'ievadīt raksta numuru',
        'total_posts' => ':posts_count raksti kopumā',
    ],

    'topic' => [
        'confirm_destroy' => 'Vai tiešām dzēst tēmu?',
        'confirm_restore' => 'Vai tiešām atjaunot tēmu?',
        'deleted' => 'izdzēstā tēma',
        'go_to_latest' => 'skatīt beidzamo rakstu',
        'has_replied' => 'Jūs atbildējāt uz šo tēmu',
        'in_forum' => 'iekš :forum',
        'latest_post' => ':when no :user',
        'latest_reply_by' => 'beidzamā atbilde no :user',
        'new_topic' => 'Jauna tēma',
        'new_topic_login' => 'Ielogojieties, lai publicētu jaunu tēmu',
        'post_reply' => 'Publicēt',
        'reply_box_placeholder' => 'Rakstiet šeit, lai atbildētu',
        'reply_title_prefix' => 'Re',
        'started_by' => 'autors: :user',
        'started_by_verbose' => 'iesāka :user',

        'actions' => [
            'destroy' => 'Dzēst tēmu',
            'restore' => 'Atjaunot tēmu',
        ],

        'create' => [
            'close' => 'Aizslēgts',
            'preview' => 'Priekšskatījums',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Rakstīt',
            'submit' => 'Publicēt',

            'necropost' => [
                'default' => 'Šī tēma jau kādu laiku ir neaktīva. Publicējiet šeit tikai tad, ja jums ir konkrēts iemesls to darīt.',

                'new_topic' => [
                    '_' => "Šī tēma jau kādu laiku ir neaktīva. Ja jums nav konkrēta iemesla šeit rakstīt, lūdzu, tā vietā: :create",
                    'create' => 'izveidot jaunu tēmu',
                ],
            ],

            'placeholder' => [
                'body' => 'Ievadiet raksta saturu šeit',
                'title' => 'Klikšķiniet šeit, lai iestatītu nosaukumu',
            ],
        ],

        'jump' => [
            'enter' => 'noklikšķiniet, lai ievadītu konkrētu raksta numuru',
            'first' => 'doties uz pirmo rakstu',
            'last' => 'doties uz pēdējo rakstu',
            'next' => 'izlaist nākamos 10 rakstus',
            'previous' => 'atgriezties 10 rakstus atpakaļ',
        ],

        'logs' => [
            '_' => 'Tēmas žurnāli',
            'button' => 'Pārlūkot tēmas žurnālus',

            'columns' => [
                'action' => 'Darbība',
                'date' => 'Datums',
                'user' => 'Lietotājs',
            ],

            'data' => [
                'add_tag' => 'pievienots ":tag" tags',
                'announcement' => 'tēma ir piesprausta un atzīmēta kā paziņojums',
                'edit_topic' => 'uz :title',
                'fork' => 'no :topic',
                'pin' => 'piesprausta tēma',
                'post_operation' => 'publicēja :username',
                'remove_tag' => 'noņemts ":tag" tags',
                'source_forum_operation' => 'no :forum',
                'unpin' => 'atsprausta tēma',
            ],

            'no_results' => 'žurnāli nav atrasti...',

            'operations' => [
                'delete_post' => 'Izdzēsts raksts',
                'delete_topic' => 'Izdzēsta tēma',
                'edit_topic' => '',
                'edit_poll' => '',
                'fork' => '',
                'issue_tag' => '',
                'lock' => '',
                'merge' => '',
                'move' => '',
                'pin' => '',
                'post_edited' => '',
                'restore_post' => '',
                'restore_topic' => '',
                'split_destination' => '',
                'split_source' => '',
                'topic_type' => '',
                'topic_type_changed' => '',
                'unlock' => '',
                'unpin' => '',
                'user_lock' => '',
                'user_unlock' => '',
            ],
        ],

        'post_edit' => [
            'cancel' => '',
            'post' => '',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => '',

            'box' => [
                'total' => '',
                'unread' => '',
            ],

            'info' => [
                'total' => '',
                'unread' => '',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => '',
                'title' => '',
            ],
        ],
    ],

    'topics' => [
        '_' => '',

        'actions' => [
            'login_reply' => '',
            'reply' => '',
            'reply_with_quote' => '',
            'search' => '',
        ],

        'create' => [
            'create_poll' => '',

            'preview' => '',

            'create_poll_button' => [
                'add' => '',
                'remove' => '',
            ],

            'poll' => [
                'hide_results' => '',
                'hide_results_info' => '',
                'length' => '',
                'length_days_suffix' => '',
                'length_info' => '',
                'max_options' => '',
                'max_options_info' => '',
                'options' => '',
                'options_info' => '',
                'title' => '',
                'vote_change' => '',
                'vote_change_info' => '',
            ],
        ],

        'edit_title' => [
            'start' => 'Rediģēt nosaukumu',
        ],

        'index' => [
            'feature_votes' => 'zvaigznes prioritāte',
            'replies' => 'atbildes',
            'views' => 'skatījumi',
        ],

        'issue_tag_added' => [
            'to_0' => 'Noņemt "pievienots" piespraudni',
            'to_0_done' => 'Noņemts "pievienots" piespraudnis',
            'to_1' => 'Pievienot "pievienots" piespraudni',
            'to_1_done' => 'Pievienots "pievienots" piespraudnis',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'Noņemt "piešķirts" piespraudni',
            'to_0_done' => 'Noņemts "piešķirts" piespraudnis',
            'to_1' => 'Pievienot "piešķirts" piespraudni',
            'to_1_done' => 'Pievienots "piešķirts" piespraudnis',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Noņemt "apstiprināts" piespraudni',
            'to_0_done' => 'Noņemts "apstiprināts" piespraudnis',
            'to_1' => 'Pievienot "apstiprināt" piespraudnis',
            'to_1_done' => 'Pievienots "apstiprināt" piespraudnis',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Noņemt "dublicēt" piespraudni',
            'to_0_done' => 'Noņemts "dublicēt" piespraudnis',
            'to_1' => 'Pievienot "dublicēt" piespraudni',
            'to_1_done' => 'Pievienots "dublicēt" piespraudnis',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Noņemt "nederīgs" piespraudni',
            'to_0_done' => 'Noņemts "nederīgs" piespraudnis',
            'to_1' => 'Pievienot "nederīgs" piespraudni',
            'to_1_done' => 'Pievienots "nederīgs" piespraudnis',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Noņemt "atrisināts" piespraudni',
            'to_0_done' => 'Noņemts "atrisināts" piespraudnis',
            'to_1' => 'Pievienot "atrisināts" piespraudni',
            'to_1_done' => 'Pievienots "atrisināts" piespraudnis',
        ],

        'lock' => [
            'is_locked' => 'Šī tēma ir slēgta un nav iespējams caur to atbildēt',
            'to_0' => 'Atvērt tēmu',
            'to_0_confirm' => '',
            'to_0_done' => 'Tēma tika atvērta',
            'to_1' => 'Slēgt tēmu',
            'to_1_confirm' => '',
            'to_1_done' => 'Tēma tika slēgta',
        ],

        'moderate_move' => [
            'title' => 'Pārvietot uz citu forumu',
        ],

        'moderate_pin' => [
            'to_0' => 'Atspraust tēmu',
            'to_0_confirm' => '',
            'to_0_done' => 'Tēma tika atsprausta',
            'to_1' => 'Piespraust tēmu',
            'to_1_confirm' => '',
            'to_1_done' => 'Tēma tika piesprausta',
            'to_2' => 'Piespraust tēmu un atzīmēt kā paziņojumu',
            'to_2_confirm' => '',
            'to_2_done' => 'Tēma tika piesprausta un atzīmēta kā paziņojums',
        ],

        'moderate_toggle_deleted' => [
            'show' => 'Rādīt dzēstos rakstus',
            'hide' => 'Slēpt dzēstos rakstus',
        ],

        'show' => [
            'deleted-posts' => 'Dzēstie Raksti',
            'total_posts' => 'Raksti Kopumā',

            'feature_vote' => [
                'current' => 'Pašreizējā Prioritāte: +:count',
                'do' => 'Paaugstināt šo pieprasījumu',

                'info' => [
                    '_' => 'Šī ir :feature_request. Iezīmētie pieprasījumi var tikt nobalsoti ar :supporters.',
                    'feature_request' => 'iezīmēt pieprasījumu',
                    'supporters' => 'atbalstītāji',
                ],

                'user' => [
                    'count' => '{0} nav balsu|{1} :count_delimited balss|[2,*] :count_delimited balsis',
                    'current' => '',
                    'not_enough' => "",
                ],
            ],

            'poll' => [
                'edit' => 'Balsošanas Rediģēšana',
                'edit_warning' => 'Rediģējot balsošanas metodi tiks noņemti visi esošie rezultāti!',
                'vote' => '',

                'button' => [
                    'change_vote' => 'Mainīt balsi',
                    'edit' => 'Rediģēt balsošanu',
                    'view_results' => 'Pārlēkt uz rezultātiem',
                    'vote' => 'Balsot',
                ],

                'detail' => [
                    'end_time' => '',
                    'ended' => '',
                    'results_hidden' => '',
                    'total' => '',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => '',
            'to_watching' => '',
            'to_watching_mail' => '',
            'tooltip_mail_disable' => '',
            'tooltip_mail_enable' => '',
        ],
    ],
];
