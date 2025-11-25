<?php

use Craft\Inertia\Inertia;
use Craft\Inertia\Manifest\ManifestCore;

return [
	'services' => [
		'value'    => [
			Inertia::class      => [
				'className' => Inertia::class,
			],
			ManifestCore::class => [
				'className' => ManifestCore::class,
			],
		],
		'readonly' => true,
	],
];