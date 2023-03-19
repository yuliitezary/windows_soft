<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => '编辑前请先登录。',
            'system_generated' => '无法编辑系统回复。',
            'wrong_user' => '只有作者可以编辑。',
        ],
    ],

    'events' => [
        'empty' => '还没有什么时间呢......目前为止。',
    ],

    'index' => [
        'deleted_beatmap' => '已删除',
        'none_found' => '找不到符合条件的讨论内容',
        'title' => '谱面讨论',

        'form' => [
            '_' => '搜索',
            'deleted' => '包含已经删除的讨论',
            'mode' => '谱面模式',
            'only_unresolved' => '只显示未解决的讨论',
            'types' => '评论类型',
            'username' => '用户名',

            'beatmapset_status' => [
                '_' => '谱面状态',
                'all' => '所有',
                'disqualified' => '下架 (DQ)',
                'never_qualified' => '从未过审 (Qualified)',
                'qualified' => '合格',
                'ranked' => '上架 (Ranked)',
            ],

            'user' => [
                'label' => '用户',
                'overview' => '活动总览',
            ],
        ],
    ],

    'item' => [
        'created_at' => '发帖时间',
        'deleted_at' => '删帖时间',
        'message_type' => '类型',
        'permalink' => '永久链接',
    ],

    'nearby_posts' => [
        'confirm' => '在这个时间点上没有相关的讨论记录。',
        'notice' => '发表讨论前，请检查 :timestamp 附近 (:existing_timestamps) 已存在的讨论记录。',
        'unsaved' => '此审阅中有 :count',
    ],

    'owner_editor' => [
        'button' => '难度作者',
        'reset_confirm' => '重置此难度的作者？',
        'user' => '作者',
        'version' => '难度',
    ],

    'reply' => [
        'open' => [
            'guest' => '登录以回复',
            'user' => '回复',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max 块已使用',
        'go_to_parent' => '查看审阅帖',
        'go_to_child' => '查看讨论',
        'validation' => [
            'block_too_large' => '每块只能包含最多 :limit 个字符',
            'external_references' => '审阅包含不属于此审阅问题的引用',
            'invalid_block_type' => '板块类型无效',
            'invalid_document' => '审阅无效',
            'invalid_discussion_type' => '讨论类型无效',
            'minimum_issues' => '审阅时必须指出最少 :count 个问题',
            'missing_text' => '该版块缺少文本。',
            'too_many_blocks' => '审阅只能包含 :count 个段落或问题',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => ':user 标记为已解决',
            'false' => ':user 要求重审',
        ],
    ],

    'timestamp_display' => [
        'general' => '常规',
        'general_all' => '常规（所有难度）',
    ],

    'user_filter' => [
        'everyone' => '所有人',
        'label' => '按用户筛选',
    ],
];
