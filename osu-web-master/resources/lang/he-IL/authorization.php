<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'מה לגבי לשחק !osu במקום זאת?',
    'require_login' => 'אנא כנס כדי להמשיך.',
    'require_verification' => 'בבקשה אמת בכדי להמשיך.',
    'restricted' => "לא ניתן לעשות זאת כאשר מוגבלים.",
    'silenced' => "לא ניתן לעשות זאת כאשר מושתקים.",
    'unauthorized' => 'הגישה נדחתה.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'אי אפשר לבטל את ההתרגשות.',
            'has_reply' => 'לא ניתן למחוק דיונים המכילים מענה',
        ],
        'nominate' => [
            'exhausted' => 'אינך יכול להגיש עוד מועמדויות להיום, אנא נסה מחר שוב.',
            'incorrect_state' => 'התרחשה שגיאה בעת ניסיון ביצוע הפעולה, אנא נסה לרענן את הדף.',
            'owner' => "אינך יכול להגיש מפת-שיר משלך.",
            'set_metadata' => 'אתה צריך להגדיר את ז\'אנר והשפה לפני המןעמדות.',
        ],
        'resolve' => [
            'not_owner' => 'רק פותח הדיון ובעל מפת-השיר יכולים לסיים דיון.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'רק בעל ה-beatmap או nominator/חבר קבוצת QAT יכול לפרסם הערות mapper.',
        ],

        'vote' => [
            'bot' => "לא ניתן להצביע בדיון הנוצר על ידי בוט",
            'limit_exceeded' => 'אנא המתן מעט לפני ביצוע הצבעות נוספות',
            'owner' => "לא ניתן להצביע בדיון שהוא שלך.",
            'wrong_beatmapset_state' => 'ניתן להצביע רק בדיונים של מפות-שירים בהמתנה.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'אתה יכול למחוק רק את הפוסטים שלך.',
            'resolved' => 'אתה לא יכול למחוק פוסט של מקרה פתור.',
            'system_generated' => 'אי אפשר לערוך פוסט שנוצר באופן אוטומטי.',
        ],

        'edit' => [
            'not_owner' => 'רק המעלה יכול לערוך את הפוסט.',
            'resolved' => 'אתה לא יכול לערוך פוסט של מקרה פתור.',
            'system_generated' => 'אי אפשר לערוך פוסט שנוצר באופן אוטומטי.',
        ],
    ],

    'beatmapset' => [
        'discussion_locked' => '',

        'metadata' => [
            'nominated' => 'אינך יכול לשנות את הנתונים של מפה מעומדת. צור קשר עם BN או NAT במידה ואתה חושבת שזה מוגר לא נכון.',
        ],
    ],

    'chat' => [
        'annnonce_only' => '',
        'blocked' => 'לא ניתן לשלוח הודעה למשתמש שחסם אותך או שנחסם על ידייך.',
        'friends_only' => 'המשתמש חוסם הודעות מאנשים שלא ברשימת החברים שלהם.',
        'moderated' => 'ערוץ זה כרגע ממותן.',
        'no_access' => 'אין לך גישה לערוץ זה.',
        'receive_friends_only' => '',
        'restricted' => 'אתם לא יכולים לשלוח הודעות בזמן שאתם מושתקים, מוגבלים או מגורשים.',
        'silenced' => '',
    ],

    'comment' => [
        'store' => [
            'disabled' => '',
        ],
        'update' => [
            'deleted' => "לא ניתן לערוך פוסט שנמחק.",
        ],
    ],

    'contest' => [
        'voting_over' => 'אינך יכול לשנות את הקול לאחר תקופת ההצבעה לתחרות זו.',

        'entry' => [
            'limit_reached' => '',
            'over' => '',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'אין רשות לנהל את הפורום הזה.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'ניתן למחוק רק את הפוסט הקודם.',
                'locked' => 'לא ניתן למחוק פוסט של נושא נעול.',
                'no_forum_access' => 'נדרשת גישה לפורום המבוקש.',
                'not_owner' => 'רק המעלה יכול למחוק את הפוסט.',
            ],

            'edit' => [
                'deleted' => 'לא ניתן לערוך פוסט שנמחק.',
                'locked' => 'פוסט זה נעול מעריכה.',
                'no_forum_access' => 'נדרשת גישה לפורום המבוקש.',
                'not_owner' => 'רק המעלה יכול למחוק את הפוסט.',
                'topic_locked' => 'לא ניתן לערוך פוסט של נושא נעול.',
            ],

            'store' => [
                'play_more' => 'בבקשה, נסה לשחק את המשחק לפני העלאת פוסטים בפורומים! אם יש לך בעיה עם המשחק, אנא תפרסם ב- Help and Support פורום.',
                'too_many_help_posts' => "אתה צריך לשחק את המשחק עוד בכדי שתוכל להעלות עוד פוסטים. אם אתה עדיין נתקל בבעיות בהפעלת המשחק, תשלח לאימייל support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'בבקשה תערכו את ההודעה האחרונה שלכם במקום, לפרסם שוב.',
                'locked' => 'לא ניתן לענות לשיחה נעולה.',
                'no_forum_access' => 'נדרשת גישה לפורום המבוקש.',
                'no_permission' => 'אין הרשאה לענות.',

                'user' => [
                    'require_login' => 'אנא תירשם לאתר בכדי לענות.',
                    'restricted' => "לא ניתן לענות כאשר מוגבלים.",
                    'silenced' => "לא ניתן לענות כאשר מושתקים.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'נדרשת גישה לפורום המבוקש.',
                'no_permission' => 'אין הרשאה ליצור נושא חדש.',
                'forum_closed' => 'פורום סגור ולא יכול להעלות אליו.',
            ],

            'vote' => [
                'no_forum_access' => 'נדרשת גישה לפורום המבוקש.',
                'over' => 'תשאול נגמר ולא ניתן להצביע עליו יותר.',
                'play_more' => 'הינך צריך לשחק יותר לפני הצבעה בפורום.',
                'voted' => 'שינוי ההצבעה אינו מותר.',

                'user' => [
                    'require_login' => 'אנא הירשם כדי להצביע.',
                    'restricted' => "לא ניתן להצביע כאשר מוגבלים.",
                    'silenced' => "לא ניתן להצביע כאשר מושתקים.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'גישה לפורום המבוקש נדרש.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'צוין כיסוי פסול.',
                'not_owner' => 'רק הבעלים יכולים לערוך את הכיסוי.',
            ],
            'store' => [
                'forum_not_allowed' => 'הפורום הזה לא מקבל עטיפות נושא.',
            ],
        ],

        'view' => [
            'admin_only' => 'רק מנהל יכול לראות את הפורום זה.',
        ],
    ],

    'score' => [
        'pin' => [
            'not_owner' => '',
            'too_many' => '',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'דף המשתמש נעול.',
                'not_owner' => 'ניתן לערוך את דף המשתמש שלכם בלבד.',
                'require_supporter_tag' => 'התג osu!supporter נדרש.',
            ],
        ],
    ],
];
