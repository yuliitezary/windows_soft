<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Godkendt.',
        'beatmap_owner_change' => 'Ejer af sværhedsgrad :beatmap ændret til :new_user.',
        'discussion_delete' => 'Moderator slettede diskussion :discussion.',
        'discussion_lock' => 'Diskussion for dette beatmap er blevet deaktiveret. (:text)',
        'discussion_post_delete' => 'Moderator slettede et opslag fra diskussion :discussion.',
        'discussion_post_restore' => 'Moderator gendannede et opslag fra diskussion :discussion.',
        'discussion_restore' => 'Moderator gendannede diskussion :discussion.',
        'discussion_unlock' => 'Diskussion for dette beatmap er blevet aktiveret.',
        'disqualify' => 'Diskvalificeret af :user. Årsag: :discussion (:text).',
        'disqualify_legacy' => 'Diskvalificeret af :user. Årsag: :text.',
        'genre_edit' => 'Genre ændret fra :old til :new.',
        'issue_reopen' => 'Løste problem :discussion genåbnet.',
        'issue_resolve' => 'Problem :discussion markeret som løst.',
        'kudosu_allow' => 'Kudosu nægtet fordi diskussion :discussion er blevet fjernet.',
        'kudosu_deny' => 'Diskussion :discussion er blevet nægtet kudosu.',
        'kudosu_gain' => 'Diskussion :discussion af :user opnåede stemmer nok til at få kudosu.',
        'kudosu_lost' => 'Diskussion :discussion af :user mistede stemmer, og det modtagede kudosu er blevet taget tilbage.',
        'kudosu_recalculate' => 'Diskussion :discussion har haft sit kudosu genberegnet.',
        'language_edit' => 'Sprog ændret fra :old til :new.',
        'love' => 'Elsket af :user',
        'nominate' => 'Nomineret af :user.',
        'nominate_modes' => 'Nomineret af :user (:modes).',
        'nomination_reset' => 'Nyt problem :discussion udløste en nomineringsnulstilling.',
        'nomination_reset_received' => 'Nominering af :user blev nulstillet af :source_user (:text)',
        'nomination_reset_received_profile' => 'Nomineringen blev nulstillet af :user (:text)',
        'offset_edit' => 'Online forskydning ændret fra :old til :new.',
        'qualify' => 'Dette beatmap har opnået det nødvendige antal nomineringer og er blevet kvalificeret.',
        'rank' => 'Ranked.',
        'remove_from_loved' => 'Fjernet fra Elsket af :user. (:text)',

        'nsfw_toggle' => [
            'to_0' => 'Fjernede eksplicit mærke',
            'to_1' => 'Markeret som eksplicit',
        ],
    ],

    'index' => [
        'title' => 'Beatmapset Begivenheder',

        'form' => [
            'period' => 'Periode',
            'types' => 'Typer',
        ],
    ],

    'item' => [
        'content' => 'Indhold',
        'discussion_deleted' => '[slettet]',
        'type' => 'Type',
    ],

    'type' => [
        'approve' => 'Godkendelse',
        'beatmap_owner_change' => 'Sværhedsgrad ejer ændring',
        'discussion_delete' => 'Diskussions-sletning',
        'discussion_post_delete' => 'Diskussions-svar sletning',
        'discussion_post_restore' => 'Diskussions-svar genoprettelse',
        'discussion_restore' => 'Diskussions-genoprettelse',
        'disqualify' => 'Diskvalifikation',
        'genre_edit' => 'Genre redigering',
        'issue_reopen' => 'Diskussions-genåbning',
        'issue_resolve' => 'Diskussion løsning',
        'kudosu_allow' => 'Kudosu indkomst',
        'kudosu_deny' => 'Kudosu nægtelse',
        'kudosu_gain' => 'Kudosu tjent',
        'kudosu_lost' => 'Kudosu mistet',
        'kudosu_recalculate' => 'Kudosu genberegning',
        'language_edit' => 'Redigér sprog',
        'love' => 'Elsk',
        'nominate' => 'Nominering',
        'nomination_reset' => 'Nulstilling af nominering',
        'nomination_reset_received' => 'Nulstilling af nominering modtaget',
        'nsfw_toggle' => 'Eksplicit mærke',
        'offset_edit' => 'Offset redigering',
        'qualify' => 'Kvalifikation',
        'rank' => 'Rangering',
        'remove_from_loved' => 'Elsket fjernelse',
    ],
];
