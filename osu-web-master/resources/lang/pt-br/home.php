<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => 'Baixar agora',
        'online' => '<strong>:players</strong> jogadores online em <strong>:games</strong> partidas',
        'peak' => 'Pico, :count usuários online',
        'players' => '<strong>:count</strong> jogadores registrados',
        'title' => 'bem-vindo(a)',
        'see_more_news' => 'ver mais notícias',

        'slogan' => [
            'main' => 'o melhor jogo de ritmo gratuito',
            'sub' => 'o ritmo está a um clique de distância',
        ],
    ],

    'search' => [
        'advanced_link' => 'Pesquisa avançada',
        'button' => 'Procurar',
        'empty_result' => 'Nada encontrado!',
        'keyword_required' => 'Uma palavra-chave é necessária',
        'placeholder' => 'digite para pesquisar',
        'title' => 'Pesquisar',

        'beatmapset' => [
            'login_required' => 'Inicie a sessão para procurar por beatmaps',
            'more' => ':count mais resultados de beatmaps',
            'more_simple' => 'Veja mais resultados de busca de beatmaps',
            'title' => 'Beatmaps',
        ],

        'forum_post' => [
            'all' => 'Todos os fóruns',
            'link' => 'Procurar no fórum',
            'login_required' => 'Inicie a sessão para pesquisar no fórum',
            'more_simple' => 'Veja mais resultados de busca nos fóruns',
            'title' => 'Fórum',

            'label' => [
                'forum' => 'procurar nos fóruns',
                'forum_children' => 'incluir subfóruns',
                'include_deleted' => 'incluir publicações excluídas',
                'topic_id' => 'tópico #',
                'username' => 'autor',
            ],
        ],

        'mode' => [
            'all' => 'todos',
            'beatmapset' => 'beatmap',
            'forum_post' => 'fórum',
            'user' => 'jogador',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'login_required' => 'Inicie a sessão para procurar usuários',
            'more' => ':count mais resultados de busca por usuários',
            'more_simple' => 'Veja mais resultados de busca por usuários',
            'more_hidden' => 'O limite de busca por jogador é limitado em :max. Tente refinar mais a sua pesquisa.',
            'title' => 'Jogadores',
        ],

        'wiki_page' => [
            'link' => 'Procurar na wiki',
            'more_simple' => 'Veja mais resultados de busca na wiki',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'action' => 'Baixar osu!',
        'action_lazer' => 'Baixar osu!(lazer)',
        'action_lazer_description' => 'a próxima grande atualização do osu!',
        'action_lazer_info' => 'cheque esta página para mais informações',
        'action_lazer_title' => 'experimente osu!(lazer)',
        'action_title' => 'baixar osu!',
        'for_os' => 'para :os',
        'lazer_note' => 'nota: redefinições do placar se aplicam',
        'macos-fallback' => 'usuários de macOS',
        'mirror' => 'link alternativo',
        'or' => 'ou',
        'os_version_or_later' => ':os_version ou mais novo',
        'other_os' => 'outras plataformas',
        'quick_start_guide' => 'guia de início rápido',
        'tagline' => "vamos<br>começar!",
        'video-guide' => 'guia em vídeo',

        'help' => [
            '_' => 'se você tiver problemas para iniciar o jogo ou registrar-se, :help_forum_link ou :support_button.',
            'help_forum_link' => 'visite o fórum de ajuda',
            'support_button' => 'entre em contato com o suporte',
        ],

        'os' => [
            'windows' => 'para Windows',
            'macos' => 'para macOS',
            'linux' => 'para Linux',
        ],
        'steps' => [
            'register' => [
                'title' => 'crie uma conta',
                'description' => 'siga as instruções quando iniciar o jogo para conectar-se ou criar uma nova conta',
            ],
            'download' => [
                'title' => 'baixar o jogo',
                'description' => 'clique no botão acima para baixar o instalador, depois execute-o!',
            ],
            'beatmaps' => [
                'title' => 'baixar beatmaps',
                'description' => [
                    '_' => ':browse pela vasta coleção de beatmaps criados por usuários e comece a jogar!',
                    'browse' => 'navegue',
                ],
            ],
        ],
    ],

    'user' => [
        'title' => 'dashboard',
        'news' => [
            'title' => 'Notícias',
            'error' => 'Erro ao carregar as notícias, tente atualizar a página?...',
        ],
        'header' => [
            'stats' => [
                'friends' => 'Amigos Online',
                'games' => 'Partidas',
                'online' => 'Usuários Online',
            ],
        ],
        'beatmaps' => [
            'new' => 'Novos beatmaps ranqueados',
            'popular' => 'Beatmaps Populares',
            'by_user' => 'por :user',
        ],
        'buttons' => [
            'download' => 'Baixar osu!',
            'support' => 'Apoie o osu!',
            'store' => 'osu!store',
        ],
    ],
];
