<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Nemôžete posielať prázdne správy.',
            'limit_exceeded' => 'Posielate správy príliš rýchlo, prosím, počkajte chvíľu než to skúsite znova.',
            'too_long' => 'Správa, ktorú sa snažíte poslať, je príliš dlhá.',
        ],
    ],

    'scopes' => [
        'bot' => 'Správať sa ako chat bot.',
        'identify' => 'Identifikovať vás a prezerať verejný profil.',

        'chat' => [
            'write' => 'Posielajte správy vo vašom mene.',
        ],

        'forum' => [
            'write' => 'Vytvárajte a upravujte témy a príspevky fóra vo vašom mene.',
        ],

        'friends' => [
            'read' => 'Pozrieť koho sledujete.',
        ],

        'public' => 'Čítajte verejné údaje vo vašom mene.',
    ],
];
