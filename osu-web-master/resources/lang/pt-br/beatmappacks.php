<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Coleções temáticas pré-compactadas.',
        'nav_title' => 'listagem',
        'title' => 'Pacotes de Beatmaps',

        'blurb' => [
            'important' => 'LEIA ISSO ANTES DE BAIXAR',
            'install_instruction' => 'Instalação: Assim que um pacote for baixado, extraia o conteúdo do pacote na pasta Songs da instalação do seu jogo, e o osu! fará o resto.',
            'note' => [
                '_' => 'Lembre-se que é altamente recomendado :scary, já que beatmaps mais antigos tem uma qualidade muito menor do que os mais recentes.',
                'scary' => 'baixar os pacotes de beatmaps dos mais recentes para os mais antigos',
            ],
        ],
    ],

    'show' => [
        'download' => 'Baixar',
        'item' => [
            'cleared' => 'finalizado',
            'not_cleared' => 'não finalizado',
        ],
        'no_diff_reduction' => [
            '_' => ':link não pode ser usado para completar este pacote.',
            'link' => 'Mods de redução de dificuldade',
        ],
    ],

    'mode' => [
        'artist' => 'Artista/Álbum',
        'chart' => 'Destaques',
        'featured' => '',
        'standard' => 'Standard',
        'theme' => 'Tema',
    ],

    'require_login' => [
        '_' => 'Você precisa estar :link para baixar',
        'link_text' => 'conectado',
    ],
];
