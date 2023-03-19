<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'pengaturan akun',
        'username' => 'nama pengguna',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => 'Pastikan avatarmu tunduk pada :link yang berlaku.<br/>Dengan kata lain, avatarmu harus <strong>cocok untuk segala usia</strong> tanpa mengandung unsur apa pun yang tidak dibenarkan seperti cacian, hinaan, atau hal yang bersifat sugestif.',
            'rules_link' => 'peraturan komunitas',
        ],

        'email' => [
            'new' => 'email baru',
            'new_confirmation' => 'konfirmasi email',
            'title' => 'Email',
        ],

        'password' => [
            'current' => 'kata sandi saat ini',
            'new' => 'kata sandi baru',
            'new_confirmation' => 'konfirmasi kata sandi',
            'title' => 'Kata Sandi',
        ],

        'profile' => [
            'title' => 'Profil',

            'user' => [
                'user_discord' => '',
                'user_from' => 'lokasi saat ini',
                'user_interests' => 'minat',
                'user_occ' => 'pekerjaan',
                'user_twitter' => '',
                'user_website' => 'situs web',
            ],
        ],

        'signature' => [
            'title' => 'Tanda Tangan',
            'update' => 'perbarui',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'terima notifikasi pada saat terdapat masalah baru pada beatmap yang berstatus Qualified pada mode',
        'beatmapset_disqualify' => 'terima notifikasi pada saat terdapat beatmap yang terdiskualifikasi pada mode',
        'comment_reply' => 'terima notifikasi pada saat terdapat balasan baru pada komentar yang kamu tulis',
        'title' => 'Notifikasi',
        'topic_auto_subscribe' => 'aktifkan notifikasi secara otomatis untuk topik forum baru yang kamu buat',

        'options' => [
            '_' => 'kirimkan notifikasi melalui',
            'beatmap_owner_change' => 'guest difficulty',
            'beatmapset:modding' => 'modding beatmap',
            'channel_message' => 'pesan pribadi',
            'comment_new' => 'komentar baru',
            'forum_topic_reply' => 'balasan pada topik',
            'mail' => 'email',
            'mapping' => 'pembuat beatmap',
            'push' => 'web',
            'user_achievement_unlock' => 'terbukanya medali baru',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'klien yang terizin',
        'own_clients' => 'klien yang dimiliki',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'nonaktifkan peringatan untuk beatmap yang mengandung konten eksplisit',
        'beatmapset_title_show_original' => 'tampilkan metadata beatmap dalam bahasa aslinya',
        'title' => 'Pengaturan',

        'beatmapset_download' => [
            '_' => 'tipe pengunduhan beatmap default',
            'all' => 'dengan video (apabila tersedia)',
            'direct' => 'buka melalui osu!direct',
            'no_video' => 'tanpa video',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'keyboard',
        'mouse' => 'mouse',
        'tablet' => 'tablet',
        'title' => 'Gaya Bermain',
        'touch' => 'layar sentuh',
    ],

    'privacy' => [
        'friends_only' => 'Blokir pesan pribadi dari orang yang tidak ada dalam daftar teman Anda',
        'hide_online' => 'sembunyikan keberadaan online Anda',
        'title' => 'Kebijakan Privasi',
    ],

    'security' => [
        'current_session' => 'saat ini',
        'end_session' => 'Akhiri Sesi',
        'end_session_confirmation' => 'Tindakan ini akan secara otomatis mengakhiri sesimu pada perangkat yang bersangkutan. Apakah kamu yakin?',
        'last_active' => 'Terakhir aktif:',
        'title' => 'Keamanan',
        'web_sessions' => 'sesi web',
    ],

    'update_email' => [
        'update' => 'perbarui',
    ],

    'update_password' => [
        'update' => 'perbarui',
    ],

    'verification_completed' => [
        'text' => 'Kamu dapat menutup tab/jendela ini sekarang',
        'title' => 'Verifikasi selesai',
    ],

    'verification_invalid' => [
        'title' => 'Tautan verifikasi tidak valid atau sudah tidak berlaku',
    ],
];
