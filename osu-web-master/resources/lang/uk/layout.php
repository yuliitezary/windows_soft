<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Грати наступну пісню автоматично',
    ],

    'defaults' => [
        'page_description' => 'osu! - Ритм в *натиску* від вас! Разом з Ouendan/EBA, Taiko та оригінальними ігровими режимами, а також повнофункціональним редактором рівнів.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'набор бітмап',
            'beatmapset_covers' => 'обкладинки наборів бітмап',
            'contest' => 'конкурс',
            'contests' => 'конкурси',
            'root' => 'панель управління',
        ],

        'artists' => [
            'index' => 'список',
        ],

        'beatmapsets' => [
            'show' => 'інформація',
            'discussions' => 'обговорення',
        ],

        'changelog' => [
            'index' => 'список',
        ],

        'help' => [
            'index' => 'зміст',
            'sitemap' => 'Карта сайту',
        ],

        'store' => [
            'cart' => 'корзина',
            'orders' => 'історія покупок',
            'products' => 'товари',
        ],

        'tournaments' => [
            'index' => 'перелiк',
        ],

        'users' => [
            'modding' => 'моддинг',
            'playlists' => 'плейлисти',
            'realtime' => 'мультиплеєр',
            'show' => 'інформація',
        ],
    ],

    'gallery' => [
        'close' => 'Закрити (Esc)',
        'fullscreen' => 'Повноекранний режим',
        'zoom' => 'Збільшити/зменшити',
        'previous' => 'Попередній (стрілка вліво)',
        'next' => 'Далі (стрілка вправо)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'бітмапи',
        ],
        'community' => [
            '_' => 'спільнота',
            'dev' => 'розробка',
        ],
        'help' => [
            '_' => 'допомога',
            'getAbuse' => 'повідомити про порушення',
            'getFaq' => 'чапи',
            'getRules' => 'правила',
            'getSupport' => 'мені, насправді, потрібна допомога!',
        ],
        'home' => [
            '_' => 'головна',
            'team' => 'команда',
        ],
        'rankings' => [
            '_' => 'рейтинги',
            'kudosu' => 'кудосу',
        ],
        'store' => [
            '_' => 'крамниця',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Загальні',
            'home' => 'Головна',
            'changelog-index' => 'Список змін',
            'beatmaps' => 'Бібліотека бітмап',
            'download' => 'Завантажити osu!',
        ],
        'help' => [
            '_' => 'Допомога і спільнота',
            'faq' => 'Часто задавані питання',
            'forum' => 'Форуми спільноти',
            'livestreams' => 'Прямі трансляції',
            'report' => 'Повідомити про проблему',
            'wiki' => 'Вiкi',
        ],
        'legal' => [
            '_' => 'Юридичні права і статус',
            'copyright' => 'Авторські права (DMCA)',
            'privacy' => 'Політика конфіденційності',
            'server_status' => 'Статус серверів',
            'source_code' => 'Вихідний код',
            'terms' => 'Умови використання',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => 'Невірний параметр запиту',
            'description' => '',
        ],
        '404' => [
            'error' => 'Сторінка відсутня',
            'description' => "Вибачте, але запитаної вами сторінки тут немає!",
        ],
        '403' => [
            'error' => "Ви не повинні тут бути.",
            'description' => 'Хоча, ви можете повернутися, напевне.',
        ],
        '401' => [
            'error' => "Ви не повинні тут бути.",
            'description' => 'Хоча ви можете спробувати повернутися, напевне. Або може увійти.',
        ],
        '405' => [
            'error' => 'Сторінка відсутня',
            'description' => "Вибачте, але запитаної вами сторінки тут немає!",
        ],
        '422' => [
            'error' => 'Неправильний параметр запиту',
            'description' => '',
        ],
        '429' => [
            'error' => 'Ліміт запитів перевищено',
            'description' => '',
        ],
        '500' => [
            'error' => 'О ні... Щось зламалося! ;_;',
            'description' => "Ми автоматично сповіщені про кожну помилку.",
        ],
        'fatal' => [
            'error' => 'О ні... Щось зламалося (жахливо)! ;_;',
            'description' => "Ми автоматично сповіщені про кожну помилку.",
        ],
        '503' => [
            'error' => 'Закрито на технічне обслуговування!',
            'description' => "Технічне обслуговування зазвичай займає від 5 секунд до 10 хвилин. Якщо це затягується, відкрийте :link для отримання більш детальної інформації.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Про всяк випадок, ось код, який ви можете повідомити службі підтримки!",
    ],

    'popup_login' => [
        'button' => 'увійти / зареєструватись',

        'login' => [
            'forgot' => "Я забув свої дані",
            'password' => 'пароль',
            'title' => 'Увійдіть, щоб продовжити',
            'username' => 'ім\'я користувача',

            'error' => [
                'email' => "Ім'я користувача або електронна адреса не існують",
                'password' => 'Неправильний пароль',
            ],
        ],

        'register' => [
            'download' => 'Завантажити',
            'info' => 'Завантажте osu! щоб створити свій обліковий запис!',
            'title' => "Не маєте облікового запису?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Налаштування',
            'follows' => 'Перелік підписок',
            'friends' => 'Друзі',
            'logout' => 'Вийти',
            'profile' => 'Мій профіль',
        ],
    ],

    'popup_search' => [
        'initial' => 'Введіть текст для пошуку!',
        'retry' => 'Пошук не вдався. Натисніть для повторної спроби.',
    ],
];