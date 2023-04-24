<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Перевірка',
        'info' => ':count_delimited товар в кошику ($:subtotal)|:count_delimited товару в кошику ($:subtotal)|:count_delimited товарів в кошику ($:subtotal)',
        'more_goodies' => 'Я хочу подивитися на інші товари перед завершенням замовлення',
        'shipping_fees' => 'вартість доставки',
        'title' => 'Кошик',
        'total' => 'всього',

        'errors_no_checkout' => [
            'line_1' => 'Ой йой, у вас проблеми з кошиком!',
            'line_2' => 'Видаліть або оновіть товари нижче для продовження.',
        ],

        'empty' => [
            'text' => 'Ваш кошик порожній.',
            'return_link' => [
                '_' => 'Поверніться в :link щоб знайти інші товари!',
                'link_text' => 'магазин',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Ой-йой, у нас проблеми з вашою карткою!',
        'cart_problems_edit' => 'Натисніть тут, щоб змінити.',
        'declined' => 'Ваш платіж було скасовано.',
        'delayed_shipping' => 'В даний час у нас багато замовлень. Ти можеш замовити товар, але будь ласка, пам\'ятай, що його обробка замовлення може зайняти 1-2 тижні.',
        'hide_from_activity' => 'Приховати всі теги osu!прихильник цього замовлення з моєї активності',
        'old_cart' => 'Здається ваш кошик застарів, тому був перезавантажений, будь ласка спробуйте ще раз.',
        'pay' => 'Оплатити за допомогою PayPal',
        'title_compact' => 'перевірка',

        'has_pending' => [
            '_' => 'У вас є незавершені транзакції, натисніть :link щоб завершити їх.',
            'link_text' => 'сюди',
        ],

        'pending_checkout' => [
            'line_1' => 'Ваш попередній платіж було розпочато, але не було завершено.',
            'line_2' => 'Виберіть спосіб оплати щоб оформити замовлення.',
        ],
    ],

    'discount' => 'ви заощадите :percent%',

    'invoice' => [
        'echeck_delay' => 'Оскільки оплата була через eCheck, очікування підтвердження оплати через Paypal може зайнятий до 10 днів!',
        'hide_from_activity' => 'Теги osu!прихильника в даному замовленні не показуються в останній активності.',
        'title_compact' => 'рахунок',

        'status' => [
            'processing' => [
                'title' => 'Ваш платіж ще не підтверджений!',
                'line_1' => 'Якщо ви вже заплатили, ми все ще можемо очікувати підтвердження платежу. Будь ласка, оновіть цю сторінку через хвилину або дві!',
                'line_2' => [
                    '_' => 'Якщо під час оплати виникла проблема, :link',
                    'link_text' => 'натисніть тут, щоб продовжити оплату',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Скасувати замовлення',
        'cancel_confirm' => 'Це замовлення буде скасовано і оплата не буде прийнята за цей товар. Постачальник оплати не може негайно випустити зарезервовані кошти. Ви впевнені?',
        'cancel_not_allowed' => 'Це замовлення не може бути скасоване в даний час.',
        'invoice' => 'Переглянути рахунок',
        'no_orders' => 'Ви нічого не замовляли.',
        'paid_on' => 'Замовлення розміщено :date',
        'resume' => 'Продовжити покупку',
        'shopify_expired' => 'Термін дії посилання для оформлення замовлення закінчився.',

        'item' => [
            'quantity' => 'Кількість',

            'display_name' => [
                'supporter_tag' => ':name для :username (:duration)',
            ],

            'subtext' => [
                'supporter_tag' => 'Повідомлення: :message',
            ],
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Ви не можете змінити своє замовлення тому, що його було скасовано.',
            'checkout' => 'Ви не можете змінити своє замовлення, поки воно обробляється.', // checkout and processing should have the same message.
            'default' => 'Замовлення неможливо змінити',
            'delivered' => 'Ви не можете змінити своє замовлення тому, що воно вже доставлене.',
            'paid' => 'Ви не можете змінити своє замовлення тому, що його було оплачено.',
            'processing' => 'Ви не можете змінити своє замовлення, поки воно обробляється.',
            'shipped' => 'Ви не можете змінити своє замовлення тому, що його вже відправлено.',
        ],

        'status' => [
            'cancelled' => 'Скасовано',
            'checkout' => 'Підготування',
            'delivered' => 'Доставлено',
            'paid' => 'Оплачено',
            'processing' => 'Очікування підтвердження',
            'shipped' => 'В дорозі',
        ],
    ],

    'product' => [
        'name' => 'Назва',

        'stock' => [
            'out' => 'В даний час товар немає в наявності. Зазирни сюди пізніше!',
            'out_with_alternative' => 'Даний тип в даний час відсутній на складі :(. Зазирни сюди пізніше.',
        ],

        'add_to_cart' => 'До кошика',
        'notify' => 'Повідомити мене, коли буде в наявності!',

        'notification_success' => 'ви будете сповіщені коли товар буде в наявності. натисніть :link для скасування',
        'notification_remove_text' => 'сюди',

        'notification_in_stock' => 'Цей продукт вже є в наявності!',
    ],

    'supporter_tag' => [
        'gift' => 'подарунок для гравця',
        'gift_message' => 'додайте додаткове повідомлення до вашого подарунка! (до :length символів)',

        'require_login' => [
            '_' => 'Ви маєте бути :link для покупки osu!прихильник!',
            'link_text' => 'увійти',
        ],
    ],

    'username_change' => [
        'check' => 'Введіть ім\'я, щоб перевірити його доступність!',
        'checking' => 'Перевіряємо доступність імені :username...',
        'require_login' => [
            '_' => 'Ви повинні :link для зміни ніку!',
            'link_text' => 'увійти',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];