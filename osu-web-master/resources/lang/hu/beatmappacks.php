<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Előre csomagolt, általános témákat körbeölelő beatmap gyűjtemények.',
        'nav_title' => 'listázás',
        'title' => 'Beatmap Csomagok',

        'blurb' => [
            'important' => 'OLVASD EL LETÖLTÉS ELŐTT',
            'install_instruction' => 'Telepítés: Miután letöltötte a csomagot, bontsa ki a csomag tartalmát a osu! Songs könyvtárba és osu! a többit megteszi.',
            'note' => [
                '_' => 'Valamint vedd figyelembe, hogy erősen javasolt a :scary, mivel a régebbi pályák minősége jóval alacsonyabb az újakéhoz képest.',
                'scary' => 'legújabb csomagok letöltése',
            ],
        ],
    ],

    'show' => [
        'download' => 'Letöltés',
        'item' => [
            'cleared' => 'lejátszott',
            'not_cleared' => 'nem játszott',
        ],
        'no_diff_reduction' => [
            '_' => ':link nem használhatóak e csomag teljesítéséhez.',
            'link' => 'Nehézséget csökkentő módok',
        ],
    ],

    'mode' => [
        'artist' => 'Előadó/Album',
        'chart' => 'Reflektorfény',
        'featured' => '',
        'standard' => 'Standard',
        'theme' => 'Téma',
    ],

    'require_login' => [
        '_' => 'A letöltéshez :link kell lenned',
        'link_text' => 'bejelentkezve',
    ],
];
