<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Този бийтмап в момента не може да бъде изтеглен.',
        'parts-removed' => 'Части от този бийтмап са премахнати по заявка на създателя или притежател на авторски права.',
        'more-info' => 'Кликни тук, за повече информация.',
        'rule_violation' => 'Някои части от бийтмапа са премахнати, тъй като бяха определени като неподходящи за използване в osu!.',
    ],

    'cover' => [
        'deleted' => 'Изтрит бийтмап',
    ],

    'download' => [
        'limit_exceeded' => 'Забави малко, играй повече.',
    ],

    'featured_artist_badge' => [
        'label' => 'Представени автори',
    ],

    'index' => [
        'title' => 'Списък с бийтмапове',
        'guest_title' => 'Бийтмапове',
    ],

    'panel' => [
        'empty' => 'няма бийтмапове',

        'download' => [
            'all' => 'изтегляне',
            'video' => 'изтегляне с видео',
            'no_video' => 'изтегляне без видео',
            'direct' => 'отваряне в osu!direct',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => 'Хибридният бийтмап изисква да бъде избран поне едни режим на игра за номинирането му.',
        'incorrect_mode' => 'Нямате право да номинирате за следните видове: :mode',
        'full_bn_required' => 'Трябва да сте с пълни номинаторски права, за да изпълните тази квалификационна номинация.',
        'too_many' => 'Условията за номинация вече са изпълнени.',

        'dialog' => [
            'confirmation' => 'Сигурни ли сте, че искате да номинирате този бийтмап?',
            'header' => 'Номиниране на бийтмап',
            'hybrid_warning' => 'бележка: може да се номинира само веднъж, затова се уверете че сте избрали всеки желан вид',
            'which_modes' => 'Номиниране за кои видове?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Explicit',
    ],

    'show' => [
        'discussion' => 'Дискусия',

        'deleted_banner' => [
            'title' => 'Този бийтмап беше изтрит.',
            'message' => '(само модератори могат да видят това)',
        ],

        'details' => [
            'by_artist' => '- :artist',
            'favourite' => 'добавяне в Любими',
            'favourite_login' => 'Влез, за добавяне в любими',
            'logged-out' => 'Моля, влез в профила си, за изтегляне на бийтмапове!',
            'mapped_by' => 'създаден от :mapper',
            'mapped_by_guest' => 'трудност, предложена от :mapper',
            'unfavourite' => 'премахване от Любими',
            'updated_timeago' => 'последно актуализиран :timeago',

            'download' => [
                '_' => 'Изтегляне',
                'direct' => '',
                'no-video' => 'без видео',
                'video' => 'с видео',
            ],

            'login_required' => [
                'bottom' => 'за достъп до повече функции',
                'top' => 'Влез',
            ],
        ],

        'details_date' => [
            'approved' => 'одобрен :timeago',
            'loved' => 'обичан :timeago',
            'qualified' => 'квалифициран :timeago',
            'ranked' => 'класиран :timeago',
            'submitted' => 'публикуван :timeago',
            'updated' => 'последно актуализиран :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'Имате прекалено много любими бийтмапове. Премахнете няколко от списъка и опитайте отново.',
        ],

        'hype' => [
            'action' => 'Надъхайте този бийтмап ако ви е изкефил, за да помогнете с напредъка в <strong>класирането</strong> му.',

            'current' => [
                '_' => 'Този бийтмап в момента е :status.',

                'status' => [
                    'pending' => 'изчакващ',
                    'qualified' => 'квалифициран',
                    'wip' => 'в процес на разработка',
                ],
            ],

            'disqualify' => [
                '_' => 'Ако откриете проблем с този бийтмап, моля дисквалифицирайте го :link.',
            ],

            'report' => [
                '_' => 'Ако откриете проблем в този бийтмап, моля докладвайте :link, за да уведомите отбора ни.',
                'button' => 'Докладване за проблем',
                'link' => 'тук',
            ],
        ],

        'info' => [
            'description' => 'Описание',
            'genre' => 'Жанр',
            'language' => 'Език',
            'no_scores' => 'Информацията все още се обработва...',
            'nominators' => 'Номинатори',
            'nsfw' => 'Explicit съдържание',
            'offset' => 'Онлайн offset',
            'points-of-failure' => 'Връхни точки на провал',
            'source' => 'Източник',
            'storyboard' => 'Този бийтмап съдържа анимирана история',
            'success-rate' => 'Степен на успех (%)',
            'tags' => 'Етикети',
            'video' => 'Този бийтмап съдържа видео',
        ],

        'nsfw_warning' => [
            'details' => 'В този бийтмап има explict, офензивно или неприлично съдържание. Искате ли да го разгледате въпреки това?',
            'title' => 'Explicit съдържание',

            'buttons' => [
                'disable' => 'Изключване на предупреждение',
                'listing' => 'Списък с бийтмапове',
                'show' => 'Показване',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'постигнато :when',
            'country' => 'Държавно класиране',
            'error' => 'Неуспешно зареждане на класирането',
            'friend' => 'Приятелско класиране',
            'global' => 'Глобално класиране',
            'supporter-link' => 'Кликнете <a href=":link">тук</a> за разглеждане на всички хубави екстри, които ще получите!',
            'supporter-only' => 'Трябва да сте osu!supporter за достъп до държавно, приятелско и мод-специфично класиране!',
            'title' => 'Класация',

            'headers' => [
                'accuracy' => 'Прецизност',
                'combo' => 'Макс комбо',
                'miss' => 'X',
                'mods' => 'Модове',
                'pin' => 'Закачане',
                'player' => 'Играч',
                'pp' => '',
                'rank' => 'Ранг',
                'score' => 'Точки',
                'score_total' => 'Общ брой точки',
                'time' => 'Преди',
            ],

            'no_scores' => [
                'country' => 'Няма никой от твоята държава в тази класация!',
                'friend' => 'Няма никой от приятелите ти в тази класация!',
                'global' => 'Няма никой в класацията. Защо не опитате да се класирате?',
                'loading' => 'Зареждане на резултати...',
                'unranked' => 'Некласиран бийтмап.',
            ],
            'score' => [
                'first' => 'Начело',
                'own' => 'Твоят най-добър',
            ],
            'supporter_link' => [
                '_' => 'Кликнете :here за разглеждане на всички хубави екстри които ще получите!',
                'here' => 'тук',
            ],
        ],

        'stats' => [
            'cs' => 'Големина на кръгове',
            'cs-mania' => 'Брой клавиши',
            'drain' => 'Загуба на живот',
            'accuracy' => 'Прецизност',
            'ar' => 'Скорост на достигане',
            'stars' => 'Звездна трудност',
            'total_length' => 'Продължителност (на изтощаване: :hit_length)',
            'bpm' => 'BPM',
            'count_circles' => 'Брой кръгове',
            'count_sliders' => 'Брой плъзгачи',
            'offset' => 'Онлайн offset :offset',
            'user-rating' => 'Потребителски рейтинг',
            'rating-spread' => 'Разпределение на рейтинг',
            'nominations' => 'Номинации',
            'playcount' => 'Изигран',
        ],

        'status' => [
            'ranked' => 'Класиран',
            'approved' => 'Одобрен',
            'loved' => 'Обичан',
            'qualified' => 'Квалифициран',
            'wip' => 'в прогрес',
            'pending' => 'Изчакващ',
            'graveyard' => 'Гробище',
        ],
    ],

    'spotlight_badge' => [
        'label' => 'Препоръчан',
    ],
];