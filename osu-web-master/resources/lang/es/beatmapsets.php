<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Este mapa no está actualmente disponible para su descarga.',
        'parts-removed' => 'Partes de este mapa han sido eliminadas a petición de su creador o un titular de derechos de autor.',
        'more-info' => 'Haga clic aquí para obtener más información.',
        'rule_violation' => 'Algunos de los elementos contenidos en este mapa han sido eliminados después de ser considerados no aptos para su uso en osu!.',
    ],

    'cover' => [
        'deleted' => 'Mapa eliminado',
    ],

    'download' => [
        'limit_exceeded' => 'Más despacio, juegue un poco.',
    ],

    'featured_artist_badge' => [
        'label' => 'Artista destacado',
    ],

    'index' => [
        'title' => 'Lista de mapas',
        'guest_title' => 'Mapas',
    ],

    'panel' => [
        'empty' => 'sin mapas',

        'download' => [
            'all' => 'descargar',
            'video' => 'descargar con vídeo',
            'no_video' => 'descargar sin vídeo',
            'direct' => 'abrir en osu!direct',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => 'Un set de mapas híbrido requiere que seleccione al menos un modo de juego para nominar.',
        'incorrect_mode' => 'No tiene permiso para nominar para el modo: :mode',
        'full_bn_required' => 'Debe ser un nominador completo para realizar esta nominación calificada.',
        'too_many' => 'Requisito de nominación ya cumplido.',

        'dialog' => [
            'confirmation' => '¿Seguro que desea nominar este mapa?',
            'header' => 'Nominar mapa',
            'hybrid_warning' => 'nota: solo puede nominar una vez, así que asegúrese de que está nominando para todos los modos de juego que desee',
            'which_modes' => '¿Nominar para qué modos?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Explícito',
    ],

    'show' => [
        'discussion' => 'Discusión',

        'deleted_banner' => [
            'title' => 'Este mapa ha sido eliminado.',
            'message' => '(solo los moderadores pueden ver esto)',
        ],

        'details' => [
            'by_artist' => 'por :artist',
            'favourite' => 'Marcar como favorito',
            'favourite_login' => 'Inicie sesión para marcar este mapa como favorito',
            'logged-out' => '¡Necesitas iniciar sesión antes de descargar cualquier mapa!',
            'mapped_by' => 'mapeado por :mapper',
            'mapped_by_guest' => 'dificultad de invitado por :mapper',
            'unfavourite' => 'Desmarcar como favorito',
            'updated_timeago' => 'actualizado por última vez :timeago',

            'download' => [
                '_' => 'Descargar',
                'direct' => '',
                'no-video' => 'sin vídeo',
                'video' => 'con vídeo',
            ],

            'login_required' => [
                'bottom' => 'para acceder a más características',
                'top' => 'Iniciar sesión',
            ],
        ],

        'details_date' => [
            'approved' => 'aprobado :timeago',
            'loved' => 'amado :timeago',
            'qualified' => 'calificado :timeago',
            'ranked' => 'clasificado :timeago',
            'submitted' => 'enviado :timeago',
            'updated' => 'actualizado por última vez :timeago',
        ],

        'favourites' => [
            'limit_reached' => '¡Tienes demasiados mapas favoritos! Por favor, desmarca algunos antes de volver a intentarlo.',
        ],

        'hype' => [
            'action' => 'Hypea este mapa si te gustó jugarlo para ayudar a que progrese al estado de <strong>Clasificado</strong>.',

            'current' => [
                '_' => 'Este mapa está actualmente :status.',

                'status' => [
                    'pending' => 'pendiente',
                    'qualified' => 'calificado',
                    'wip' => 'en proceso de elaboración',
                ],
            ],

            'disqualify' => [
                '_' => 'Si encuentras un problema con este mapa, por favor descalifícalo :link.',
            ],

            'report' => [
                '_' => 'Si encuentras un problema con este mapa, por favor repórtalo :link para alertar al equipo.',
                'button' => 'Informar un problema',
                'link' => 'aquí',
            ],
        ],

        'info' => [
            'description' => 'Descripción',
            'genre' => 'Género',
            'language' => 'Idioma',
            'no_scores' => 'Los datos todavía están siendo calculados...',
            'nominators' => 'Nominadores',
            'nsfw' => 'Contenido explícito',
            'offset' => 'Compensación en línea',
            'points-of-failure' => 'Puntos de fracaso',
            'source' => 'Fuente',
            'storyboard' => 'Este mapa contiene storyboard',
            'success-rate' => 'Tasa de éxito',
            'tags' => 'Etiquetas',
            'video' => 'Este mapa contiene vídeo',
        ],

        'nsfw_warning' => [
            'details' => 'Este mapa contiene contenido explícito, ofensivo o perturbador. ¿Desea verlo de todos modos?',
            'title' => 'Contenido explícito',

            'buttons' => [
                'disable' => 'Desactivar advertencia',
                'listing' => 'Volver a lista de mapas',
                'show' => 'Mostrar',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'logrado :when',
            'country' => 'Clasificación nacional',
            'error' => 'Error al cargar las clasificaciones',
            'friend' => 'Clasificación entre amigos',
            'global' => 'Clasificación global',
            'supporter-link' => '¡Clic <a href=":link">aquí</a> para ver todas las características de lujo que ofrece!',
            'supporter-only' => '¡Debe ser un osu!supporter para acceder a las clasificaciones nacionales y entre amigos!',
            'title' => 'Tabla de puntuaciones',

            'headers' => [
                'accuracy' => 'Precisión',
                'combo' => 'Combo máximo',
                'miss' => 'Fallos',
                'mods' => 'Mods',
                'pin' => 'Anclar',
                'player' => 'Jugador',
                'pp' => '',
                'rank' => 'Puesto',
                'score' => 'Puntuación',
                'score_total' => 'Puntuación total',
                'time' => 'Tiempo',
            ],

            'no_scores' => [
                'country' => '¡Nadie de tu país ha establecido una puntuación en este mapa aún!',
                'friend' => '¡Ninguno de tus amigos ha marcado una puntuación en este mapa aún!',
                'global' => 'Sin puntuaciones aún. ¿Tal vez deberías intentar establecer alguna?',
                'loading' => 'Cargando puntuaciones...',
                'unranked' => 'Mapa no clasificado.',
            ],
            'score' => [
                'first' => 'Liderando',
                'own' => 'Tu mejor puntuación',
            ],
            'supporter_link' => [
                '_' => '¡Clic :here para ver todas las características de lujo que ofrece!',
                'here' => 'aquí',
            ],
        ],

        'stats' => [
            'cs' => 'Tamaño del círculo',
            'cs-mania' => 'Cantidad de teclas',
            'drain' => 'Drenado de HP',
            'accuracy' => 'Precisión',
            'ar' => 'Velocidad de aproximación',
            'stars' => 'Estrellas de dificultad',
            'total_length' => 'Duración (Duración del drenaje: :hit_length)',
            'bpm' => 'BPM',
            'count_circles' => 'Número de círculos',
            'count_sliders' => 'Número de deslizadores',
            'offset' => 'Compensación en línea: :offset',
            'user-rating' => 'Valoración de los usuarios',
            'rating-spread' => 'Desglose de valoraciones',
            'nominations' => 'Nominaciones',
            'playcount' => 'Veces jugado',
        ],

        'status' => [
            'ranked' => 'Clasificado',
            'approved' => 'Aprobado',
            'loved' => 'Amado',
            'qualified' => 'Calificado',
            'wip' => 'WIP',
            'pending' => 'Pendiente',
            'graveyard' => 'Abandonado',
        ],
    ],

    'spotlight_badge' => [
        'label' => 'Destacado',
    ],
];
