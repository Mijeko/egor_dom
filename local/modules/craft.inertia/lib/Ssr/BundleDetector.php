<?php

namespace Craft\Inertia\Ssr;

class BundleDetector
{
    public function detect(): ?string
    {
        return array_filter([
            dirname(__DIR__, 5) . '/markup/ssr/ssr.mjs',
            dirname(__DIR__, 5) . '/markup/ssr/ssr.js',
            dirname(__DIR__, 5) . '/markup/ssr/ssr.cjs',
        ], fn($path) => file_exists($path))[0] ?? null;
    }
}
