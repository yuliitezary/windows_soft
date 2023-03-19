<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'load_failed' => 'Не удалось загрузить данные.',
    'missing_route' => 'Неверный url или неправильный метод запроса.',
    'no_restricted_access' => 'Вы не можете использовать данную функцию пока ваши права ограничены.',
    'supporter_only' => 'Вы должны иметь тег osu!supporter для использования этой возможности.',
    'unknown' => 'Возникла неизвестная ошибка.',

    'codes' => [
        'http-401' => 'Войдите для продолжения.',
        'http-403' => 'Доступ запрещён.',
        'http-404' => 'Не найдено.',
        'http-429' => 'Слишком много попыток. Попробуйте позже.',
    ],
    'account' => [
        'profile-order' => [
            'generic' => 'Возникла ошибка. Попробуй перезагрузить страницу.',
        ],
    ],
    'beatmaps' => [
        'invalid_mode' => 'Указан недопустимый мод.',
        'standard_converts_only' => 'Результатов для запрашиваемого мода нет.',
    ],
    'checkout' => [
        'generic' => 'Произошла ошибка при обработке вашего заказа.',
    ],
    'search' => [
        'default' => 'Не удалось что-либо найти, повторите позже.',
        'invalid_cursor_exception' => 'Задан неверный параметр курсора.',
        'operation_timeout_exception' => 'Поиск сейчас перегружен, попробуйте позже.',
    ],
];
