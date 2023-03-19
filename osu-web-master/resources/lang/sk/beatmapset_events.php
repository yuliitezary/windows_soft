<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Schválené.',
        'beatmap_owner_change' => 'Majiteľ obtiažnosti :beatmap sa zmenil na :new_user.',
        'discussion_delete' => 'Moderátor vymazal diskusiu :discussion.',
        'discussion_lock' => 'Diskusia o tejto beatmape bola zakázaná. (:text)',
        'discussion_post_delete' => 'Moderátor vymazal príspevok z diskusie :discussion.',
        'discussion_post_restore' => 'Moderátor obnovil príspevok z diskusie :discussion.',
        'discussion_restore' => 'Moderátor obnovil diskusiu :discussion.',
        'discussion_unlock' => 'Diskusia o tejto beatmape bola povolená.',
        'disqualify' => 'Diskvalifikovaný užívateľom :user. Dôvod: :discussion (:text).',
        'disqualify_legacy' => 'Diskvalifikovaný užívateľom :user. Dôvod: :text.',
        'genre_edit' => 'Žáner zmenený z :old na :new.',
        'issue_reopen' => 'Problém vyriešený :discussion bol znova otvorený.',
        'issue_resolve' => 'Problém :discussion bol označený ako vyriešený.',
        'kudosu_allow' => 'Odmietnutie Kudosu pre diskusiu :discussion bolo odstránené.',
        'kudosu_deny' => 'Diskusia :discussion zamietla pre kudosu.',
        'kudosu_gain' => 'Diskusia :discussion užívateľom :user dosiahla dostatok hlasov pre kudosu.',
        'kudosu_lost' => 'Diskusia :discussion použivateľa :user stratila hlasy a získane kudosu bolo odobrané.',
        'kudosu_recalculate' => 'Diskusii :discussion boli získané kudosu prepočítané.',
        'language_edit' => 'Jazyk zmenený z :old na :new.',
        'love' => 'Obľúbené používateľom :user',
        'nominate' => 'Nominované užívateľom :user.',
        'nominate_modes' => 'Nominované užívateľom :user (:modes).',
        'nomination_reset' => 'Nový problém :discussion (:text) spôsobil zresetovanie nominácie.',
        'nomination_reset_received' => 'Nominácia užívateľom :user bola resetovaná užívateľom :source_user (:text)',
        'nomination_reset_received_profile' => 'Nominácia bola resetovaná užívateľom :user (:text)',
        'offset_edit' => 'Online offset zmenený z :old na :new.',
        'qualify' => 'Táto beatmapa dosiahla požadované číslo nominácii a bola kvalifikovaná.',
        'rank' => 'Ranked.',
        'remove_from_loved' => 'Odstránené z Loved užívateľom :user. (:text)',

        'nsfw_toggle' => [
            'to_0' => 'Odobrané explicitní označenie ',
            'to_1' => 'Označené ako explicitné',
        ],
    ],

    'index' => [
        'title' => 'Udalosti beatmapsetu',

        'form' => [
            'period' => 'Obdobie',
            'types' => 'Typ',
        ],
    ],

    'item' => [
        'content' => 'Obsah',
        'discussion_deleted' => '[vymazané]',
        'type' => 'Typ',
    ],

    'type' => [
        'approve' => 'Schválenie',
        'beatmap_owner_change' => 'Zmena majiteľa obtiažnosti ',
        'discussion_delete' => 'Odstránenie diskusie',
        'discussion_post_delete' => 'Odstránenie odpovedi diskusie',
        'discussion_post_restore' => 'Obnovenie odpovedi diskusie',
        'discussion_restore' => 'Obnovenie diskusie',
        'disqualify' => 'Diskvalifikácia',
        'genre_edit' => 'Úprava žáneru',
        'issue_reopen' => 'Znovuotvorenie diskusie',
        'issue_resolve' => 'Vyriešenie diskusie',
        'kudosu_allow' => 'Prídavok Kudosu',
        'kudosu_deny' => 'Neuznanie kudosu',
        'kudosu_gain' => 'Zisk kudosu',
        'kudosu_lost' => 'Strata kudosu',
        'kudosu_recalculate' => 'Prepočet kudosu',
        'language_edit' => 'Úprava jazyka',
        'love' => 'Obľuba',
        'nominate' => 'Nominácia',
        'nomination_reset' => 'Reštart nominácie',
        'nomination_reset_received' => 'Nominačný reset obdržaný',
        'nsfw_toggle' => 'Explicitné označenie ',
        'offset_edit' => 'Úprava offsetu',
        'qualify' => 'Kvalifikácia',
        'rank' => 'Hodnotenie',
        'remove_from_loved' => 'Odstránenie z Loved',
    ],
];
