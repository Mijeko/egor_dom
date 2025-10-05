<?php

use Craft\Inertia\Inertia;

return [
    'services' => [
        'value' => [
            Inertia::class => [
                'className' => Inertia::class,
            ],
        ],
        'readonly' => true,
    ],
];