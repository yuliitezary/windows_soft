<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'В целях безопасности мы отправили на вашу почту :mail письмо с кодом подтверждения. Введите полученный код.',
        'title' => 'Подтверждение аккаунта',
        'verifying' => 'Проверка кода...',
        'issuing' => 'Отправка нового кода...',

        'info' => [
            'check_spam' => "Проверьте папку «Спам», если Вы не можете найти письмо.",
            'recover' => "Если Вы потеряли доступ к вашей почте или забыли, какую почту Вы использовали, пройдите :link.",
            'recover_link' => 'процедуру восстановления',
            'reissue' => 'Также, Вы можете :reissue_link или :logout_link.',
            'reissue_link' => 'запросить другой код',
            'logout_link' => 'выйти',
        ],
    ],

    'errors' => [
        'expired' => 'Код подтверждения устарел, отправлено новое письмо.',
        'incorrect_key' => 'Неверный код.',
        'retries_exceeded' => 'Неверный код. Вы привысили лимит попыток, поэтому Вам отправлено новое письмо.',
        'reissued' => 'Код подтверждения устарел, отправлено новое письмо.',
        'unknown' => 'Произошла неизвестная ошибка, отправлено новое письмо.',
    ],
];
