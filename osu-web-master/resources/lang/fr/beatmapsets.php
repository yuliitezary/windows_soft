<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Cette beatmap n\'est actuellement pas disponible au téléchargement.',
        'parts-removed' => 'Des parties de cette beatmap ont été supprimées suite à la requête du créateur ou d\'un titulaire de droits tiers.',
        'more-info' => 'Pour plus d\'informations, cliquez ici.',
        'rule_violation' => 'Certains éléments contenus dans cette beatmap ont été supprimés après avoir été jugés inappropriés pour osu!.',
    ],

    'cover' => [
        'deleted' => 'Beatmap supprimée',
    ],

    'download' => [
        'limit_exceeded' => 'Ralentissez, jouez plus.',
    ],

    'featured_artist_badge' => [
        'label' => 'Featured artist',
    ],

    'index' => [
        'title' => 'Liste des beatmaps',
        'guest_title' => 'Beatmaps',
    ],

    'panel' => [
        'empty' => 'pas de beatmaps',

        'download' => [
            'all' => 'télécharger',
            'video' => 'télécharger avec la vidéo',
            'no_video' => 'télécharger sans la vidéo',
            'direct' => 'ouvrir dans osu!direct',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => 'Un beatmapset hybride nécessite de sélectionner au moins un mode de jeu à nominer.',
        'incorrect_mode' => 'Vous n\'avez pas la permission de nominer pour le mode :mode',
        'full_bn_required' => 'Vous devez être un Beatmap Nominator confirmé pour effectuer cette qualification.',
        'too_many' => 'L\'exigence de nomination est déjà remplie.',

        'dialog' => [
            'confirmation' => 'Êtes-vous sûr de vouloir nominer cette beatmap ?',
            'header' => 'Nominer la beatmap',
            'hybrid_warning' => 'remarque : vous ne pouvez nominer qu\'une seule fois, assurez-vous que vous nominez pour tous les modes de jeu que vous souhaitez',
            'which_modes' => 'Nominer pour quels modes ?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Explicite',
    ],

    'show' => [
        'discussion' => 'Discussion',

        'deleted_banner' => [
            'title' => 'Cette beatmap a été supprimée.',
            'message' => '(seuls les modérateurs peuvent voir ceci)',
        ],

        'details' => [
            'by_artist' => 'par :artist',
            'favourite' => 'Ajouter ce beatmapset aux favoris',
            'favourite_login' => 'Connectez-vous pour ajouter cette beatmap aux favoris',
            'logged-out' => 'Vous devez vous connecter pour pouvoir télécharger des beatmaps !',
            'mapped_by' => 'mappée par :mapper',
            'mapped_by_guest' => 'guest difficulty par :mapper',
            'unfavourite' => 'Retirer cette beatmapset des favoris',
            'updated_timeago' => 'dernière mise à jour le :timeago',

            'download' => [
                '_' => 'Télécharger',
                'direct' => '',
                'no-video' => 'sans Vidéo',
                'video' => 'avec Vidéo',
            ],

            'login_required' => [
                'bottom' => 'pour accéder à plus de fonctionnalités',
                'top' => 'Se connecter',
            ],
        ],

        'details_date' => [
            'approved' => 'approuvé le :timeago',
            'loved' => 'a été loved le :timeago',
            'qualified' => 'qualifiée le :timeago',
            'ranked' => 'classée le :timeago',
            'submitted' => 'publiée le :timeago',
            'updated' => 'dernière mise à jour le :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'Vous avez trop de beatmaps favorites ! Veuillez en supprimer quelques-unes avant d\'essayer à nouveau.',
        ],

        'hype' => [
            'action' => 'Hypez cette beatmap si vous avez aimé la jouer afin qu’elle progresse au statut de beatmap <strong>classée</strong>.',

            'current' => [
                '_' => 'Cette beatmap est actuellement :status.',

                'status' => [
                    'pending' => 'en attente',
                    'qualified' => 'qualifiée',
                    'wip' => 'work in progress',
                ],
            ],

            'disqualify' => [
                '_' => 'Si vous trouvez un problème sur cette beatmap, veuillez la disqualifier :link.',
            ],

            'report' => [
                '_' => 'Si vous trouvez un problème sur cette beatmap, merci de le signaler :link pour alerter l\'équipe.',
                'button' => 'Signaler un problème',
                'link' => 'ici',
            ],
        ],

        'info' => [
            'description' => 'Description',
            'genre' => 'Genre',
            'language' => 'Langue',
            'no_scores' => 'Les données sont encore en cours de calcul...',
            'nominators' => 'Nominateurs',
            'nsfw' => 'Contenu explicite',
            'offset' => 'Décalage en ligne',
            'points-of-failure' => 'Répartition des échecs',
            'source' => 'Source',
            'storyboard' => 'Cette beatmap contient un storyboard',
            'success-rate' => 'Taux de réussite',
            'tags' => 'Tags',
            'video' => 'Cette beatmap contient une vidéo',
        ],

        'nsfw_warning' => [
            'details' => 'Cette beatmap contient du contenu explicite, offensant ou perturbant. Voulez-vous la voir quand même ?',
            'title' => 'Contenu explicite',

            'buttons' => [
                'disable' => 'Désactiver l\'avertissement',
                'listing' => 'Liste des beatmaps',
                'show' => 'Afficher',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'réalisé :when',
            'country' => 'Classement national',
            'error' => 'Échec du chargement du classement',
            'friend' => 'Classement des amis',
            'global' => 'Classement global',
            'supporter-link' => 'Cliquez <a href=":link">ici</a> pour connaître toutes les supers fonctions obtenues avec !',
            'supporter-only' => 'Vous devez être un osu!supporter pour accéder à cette fonctionnalité !',
            'title' => 'Tableaux des scores',

            'headers' => [
                'accuracy' => 'Précision',
                'combo' => 'Combo max',
                'miss' => 'Manqué',
                'mods' => 'Mods',
                'pin' => 'Épingler',
                'player' => 'Joueur',
                'pp' => '',
                'rank' => 'Rang',
                'score' => 'Score',
                'score_total' => 'Score total',
                'time' => 'Date',
            ],

            'no_scores' => [
                'country' => 'Personne de votre pays n\'a encore fait un score !',
                'friend' => 'Aucun de vos amis n\'a encore établi de score sur cette map !',
                'global' => 'Pas de scores. Peut-être devriez vous en faire un ?',
                'loading' => 'Chargement des scores...',
                'unranked' => 'Beatmap non classée.',
            ],
            'score' => [
                'first' => 'En Tête',
                'own' => 'Votre meilleur score',
            ],
            'supporter_link' => [
                '_' => 'Cliquez :here pour connaître toutes les supers fonctions que vous obtiendrez !',
                'here' => 'ici',
            ],
        ],

        'stats' => [
            'cs' => 'Taille des Cercles',
            'cs-mania' => 'Nombre de touches',
            'drain' => 'Drain de santé',
            'accuracy' => 'Précision',
            'ar' => 'Taux d\'approche',
            'stars' => 'Difficulté en étoiles',
            'total_length' => 'Durée (drain time : :hit_length)',
            'bpm' => 'BPM',
            'count_circles' => 'Nombre de Cercles',
            'count_sliders' => 'Nombre de Sliders',
            'offset' => 'Décalage en ligne : :offset',
            'user-rating' => 'Évaluation des joueurs',
            'rating-spread' => 'Écart de notation',
            'nominations' => 'Nominations',
            'playcount' => 'Nombre de parties',
        ],

        'status' => [
            'ranked' => 'Classée',
            'approved' => 'Approuvée',
            'loved' => 'Loved',
            'qualified' => 'Qualifiée',
            'wip' => 'WIP',
            'pending' => 'En attente',
            'graveyard' => 'Cimetière',
        ],
    ],

    'spotlight_badge' => [
        'label' => 'Spotlights',
    ],
];
