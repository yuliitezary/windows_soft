<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Вы мусіце ўвайсці для рэдагавання.',
            'system_generated' => 'Сістэмныя допісы немагчыма адрэдагаваць.',
            'wrong_user' => 'Вы павінны быць уладальнікам допісу для рэдагавання.',
        ],
    ],

    'events' => [
        'empty' => 'Нічога не адбылося... яшчэ.',
    ],

    'index' => [
        'deleted_beatmap' => 'выдалена',
        'none_found' => 'Не знойдзена абмеркаванняў, супадаючых з гэтымі крытэрыямі пошука.',
        'title' => 'Абмеркаванне бітмап',

        'form' => [
            '_' => 'Пошук',
            'deleted' => 'Уключаючы выдаленыя абмеркаванні',
            'mode' => 'Рэжым бітмапы',
            'only_unresolved' => 'Паказаць толькі нявырашаныя абмеркаванні',
            'types' => 'Тыпы памедамленняў',
            'username' => 'Імя карыстальніка',

            'beatmapset_status' => [
                '_' => 'Статус бітмапы',
                'all' => 'Усе',
                'disqualified' => 'Дыскваліфікаваны',
                'never_qualified' => 'Ніколі ні кваліфікавана',
                'qualified' => 'Кваліфікавана',
                'ranked' => 'Ранкавана',
            ],

            'user' => [
                'label' => 'Карыстальнік',
                'overview' => 'Агляд актыўнасці',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Дата размяшчэння',
        'deleted_at' => 'Дата выдалення',
        'message_type' => 'Тып',
        'permalink' => 'Пастаянная спасылка',
    ],

    'nearby_posts' => [
        'confirm' => 'Ні адзін з допісаў не вырашае маю праблему',
        'notice' => 'Існуюць допісы між :timestamp (:existing_timestamps). Праверце іх перш, чым размяшчаць.',
        'unsaved' => ':count у гэтым аглядзе',
    ],

    'owner_editor' => [
        'button' => 'Уладальнік цяжкасті',
        'reset_confirm' => 'Скінуць уладальніка з-за гэтай складанасці?',
        'user' => 'Уладальнік',
        'version' => 'Цяжкасть',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Каб адказаць, увайдзіце',
            'user' => 'Адправіць',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max блокаў выкарыстоўваецца',
        'go_to_parent' => 'Пабачыць адказ',
        'go_to_child' => 'Пабачыць абмеркаванне',
        'validation' => [
            'block_too_large' => 'кожны блок можа ўтрымліваць не больш за :limit знакаў',
            'external_references' => 'агляд змяшчае спасылкі на праблемы, якія не належаць да гэтага агляду',
            'invalid_block_type' => 'недапушчальны тып блоку',
            'invalid_document' => 'недапушчальны адказ',
            'invalid_discussion_type' => 'няправільны тып абмеркавання',
            'minimum_issues' => 'адказ павінен утрымліваць як мінімум :count праблему|адказ павінен утрымліваць як мінімум :count праблемы|адказ павінен утрымліваць як мінімум :count праблем',
            'missing_text' => 'у блоке адсутнічае тэкст',
            'too_many_blocks' => 'адказы могуць утрымліваць толькі :count параграф/праблему|параграфы могуць утрымліваць толькі да :count параграфаў/праблем',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Пазначана як рашэнне карыстальнікам :user',
            'false' => 'Адкрыта нанова карыстальнікам :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'агульнае',
        'general_all' => 'агульнае (усе)',
    ],

    'user_filter' => [
        'everyone' => 'Усе',
        'label' => 'Фільтр па карыстальнікам',
    ],
];
