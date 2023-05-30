<?php

declare(strict_types=1);

return [
    'name' => 'Kepasa Africa',
    'manifest' => [
        'name' => env('APP_NAME', 'Kepasa Africa'),
        'short_name' => 'KPS',
        'start_url' => '/',
        'background_color' => '#ffffff',
        'theme_color' => '#000000',
        'display' => 'standalone',
        'orientation' => 'any',
        'status_bar' => 'black',
        'icons' => [
            '72x72' => [
                'path' => '/images/logo3.png',
                'purpose' => 'any',
            ],
            '96x96' => [
                'path' => '/images/logo3.png',
                'purpose' => 'any',
            ],
            '128x128' => [
                'path' => '/images/logo3.png',
                'purpose' => 'any',
            ],
            '144x144' => [
                'path' => '/images/logo3.png',
                'purpose' => 'any',
            ],
            '152x152' => [
                'path' => '/images/logo3.png',
                'purpose' => 'any',
            ],
            '192x192' => [
                'path' => '/images/logo3.png',
                'purpose' => 'any',
            ],
            '384x384' => [
                'path' => '/images/logo3.png',
                'purpose' => 'any',
            ],
            '512x512' => [
                'path' => '/images/logo3.png',
                'purpose' => 'any',
            ],
        ],
        'splash' => [
            '640x1136' => '/images/logo3.png',
            '750x1334' => '/images/logo3.png',
            '828x1792' => '/images/logo3.png',
            '1125x2436' => '/images/logo3.png',
            '1242x2208' => '/images/logo3.png',
            '1242x2688' => '/images/logo3.png',
            '1536x2048' => '/images/logo3.png',
            '1668x2224' => '/images/logo3.png',
            '1668x2388' => '/images/logo3.png',
            '2048x2732' => '/images/logo3.png',
        ],
        'shortcuts' => [
            [
                'name' => 'Shortcut Link 1',
                'description' => 'Shortcut Link 1 Description',
                'url' => '/shortcutting1',
                'icons' => [
                    'src' => '/images/logo3.png',
                    'purpose' => 'any',
                ],
            ],
            [
                'name' => 'Shortcut Link 2',
                'description' => 'Shortcut Link 2 Description',
                'url' => '/shortcutting2',
            ],
        ],
        'custom' => [],
    ],
];
