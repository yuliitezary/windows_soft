<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'load_failed' => 'Error al cargar los datos.',
    'missing_route' => 'URL no válida o método de solicitud incorrecto.',
    'no_restricted_access' => 'No puede realizar esta acción mientras su cuenta esté en un estado restringido.',
    'supporter_only' => 'Debes ser un osu!supporter para usar esta característica.',
    'unknown' => 'Se produjo un error desconocido.',

    'codes' => [
        'http-401' => 'Por favor, inicia sesión para continuar.',
        'http-403' => 'Acceso denegado.',
        'http-404' => 'No encontrado.',
        'http-429' => 'Demasiados intentos. Inténtalo de nuevo más tarde.',
    ],
    'account' => [
        'profile-order' => [
            'generic' => 'Ocurrió un error. Intente actualizar la página.',
        ],
    ],
    'beatmaps' => [
        'invalid_mode' => 'Modo especificado no válido.',
        'standard_converts_only' => 'No hay puntuaciones disponibles para el modo solicitado en esta dificultad del mapa.',
    ],
    'checkout' => [
        'generic' => 'Se produjo un error mientras se preparaba su compra.',
    ],
    'search' => [
        'default' => 'No se obtuvo ningún resultado, inténtalo de nuevo más tarde.',
        'invalid_cursor_exception' => 'Parámetro de cursor especificado no válido.',
        'operation_timeout_exception' => 'La búsqueda está más ocupada de lo habitual, inténtalo de nuevo más tarde.',
    ],
];
