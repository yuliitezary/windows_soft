<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Jouer automatiquement la musique suivante',
    ],

    'defaults' => [
        'page_description' => 'osu! - Rhythm is just a *click* away! Avec les modes de jeu Ouendan/EBA, Taiko et d\'autres modes de jeu originaux, ainsi qu\'un éditeur de niveaux entièrement fonctionnel.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'beatmapset',
            'beatmapset_covers' => 'couvertures du beatmapset',
            'contest' => 'concours',
            'contests' => 'concours',
            'root' => 'console',
        ],

        'artists' => [
            'index' => 'liste',
        ],

        'beatmapsets' => [
            'show' => 'informations',
            'discussions' => 'discussion',
        ],

        'changelog' => [
            'index' => 'liste',
        ],

        'help' => [
            'index' => 'index',
            'sitemap' => 'Aide à la navigation',
        ],

        'store' => [
            'cart' => 'panier',
            'orders' => 'historique des commandes',
            'products' => 'articles',
        ],

        'tournaments' => [
            'index' => 'liste',
        ],

        'users' => [
            'modding' => 'modding',
            'playlists' => 'playlists',
            'realtime' => 'multijoueur',
            'show' => 'infos',
        ],
    ],

    'gallery' => [
        'close' => 'Fermer (Échap)',
        'fullscreen' => 'Basculer en plein écran',
        'zoom' => 'Zoom avant/arrière',
        'previous' => 'Précédent (flèche gauche)',
        'next' => 'Suivant (flèche droite)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'beatmaps',
        ],
        'community' => [
            '_' => 'communauté',
            'dev' => 'développement',
        ],
        'help' => [
            '_' => 'aide',
            'getAbuse' => 'signaler un abus',
            'getFaq' => 'faq',
            'getRules' => 'règles',
            'getSupport' => 'non, vraiment, j\'ai besoin d\'aide !',
        ],
        'home' => [
            '_' => 'accueil',
            'team' => 'équipe',
        ],
        'rankings' => [
            '_' => 'classements',
            'kudosu' => 'kudosu',
        ],
        'store' => [
            '_' => 'magasin',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Général',
            'home' => 'Accueil',
            'changelog-index' => 'Changelog',
            'beatmaps' => 'Liste des beatmaps',
            'download' => 'Télécharger osu!',
        ],
        'help' => [
            '_' => 'Aide & Communauté',
            'faq' => 'Questions fréquemment posées',
            'forum' => 'Forums communautaire',
            'livestreams' => 'Streams en direct',
            'report' => 'Signaler une erreur',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Statut & Légal',
            'copyright' => 'Copyright (DMCA)',
            'privacy' => 'Confidentialité',
            'server_status' => 'Statut du serveur',
            'source_code' => 'Code source',
            'terms' => 'Conditions d\'utilisation',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => 'Paramètre de requête invalide',
            'description' => '',
        ],
        '404' => [
            'error' => 'Page manquante',
            'description' => "Désolé, mais la page demandée n'est pas ici !",
        ],
        '403' => [
            'error' => "Vous ne devriez pas être ici.",
            'description' => 'Vous pouvez essayer de revenir en arrière.',
        ],
        '401' => [
            'error' => "Vous ne devriez pas être ici.",
            'description' => 'Vous pouvez essayer de revenir en arrière. Ou peut-être vous connecter.',
        ],
        '405' => [
            'error' => 'Page manquante',
            'description' => "Désolé, mais la page demandée n'est pas ici !",
        ],
        '422' => [
            'error' => 'Paramètre de requête invalide',
            'description' => '',
        ],
        '429' => [
            'error' => 'Limite de tentatives atteinte',
            'description' => '',
        ],
        '500' => [
            'error' => 'Oh non ! Quelque chose s\'est cassé ! ;_;',
            'description' => "Nous avons automatiquement été notifié de cette erreur.",
        ],
        'fatal' => [
            'error' => 'Oh non ! Quelque chose s\'est cassé ! (gravement) ;_;',
            'description' => "Nous avons été automatiquement notifié de cette erreur.",
        ],
        '503' => [
            'error' => 'Maintenance en cours!',
            'description' => "Les maintenances prennent en général 5 à 10 minutes. Si c'est plus long, regardez :link pour plus d'informations.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Juste au cas où, voici un code que vous pourrez retourner au support !",
    ],

    'popup_login' => [
        'button' => 'connexion / inscription',

        'login' => [
            'forgot' => "J'ai oublié mes identifiants",
            'password' => 'mot de passe',
            'title' => 'Se connecter pour continuer',
            'username' => 'nom d\'utilisateur',

            'error' => [
                'email' => "Le nom d'utilisateur ou l'e-mail ne correspond pas",
                'password' => 'Mot de passe incorrect',
            ],
        ],

        'register' => [
            'download' => 'Télécharger',
            'info' => 'Téléchargez osu! pour créer votre propre compte !',
            'title' => "Vous n'avez pas de compte ?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Paramètres',
            'follows' => 'Listes de suivi',
            'friends' => 'Amis',
            'logout' => 'Se déconnecter',
            'profile' => 'Mon profil',
        ],
    ],

    'popup_search' => [
        'initial' => 'Écrivez pour rechercher !',
        'retry' => 'La recherche a échouée. Cliquez pour réessayer.',
    ],
];
