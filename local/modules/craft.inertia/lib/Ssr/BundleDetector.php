<?php

namespace Craft\Inertia\Ssr;

use Bitrix\Main\Diag\Debug;

class BundleDetector
{
	public function detect(string $subFolder = null): ?string
	{

		$level = 4;

		if($subFolder)
		{
			$subFolder = '/' . ($subFolder);
		}


		$folders = [
			dirname(__DIR__, $level) . '/markup' . $subFolder . '/src/ssr.ts',
			dirname(__DIR__, $level) . '/markup' . $subFolder . '/ssr/ssr.mjs',
			dirname(__DIR__, $level) . '/markup' . $subFolder . '/ssr/ssr.js',
			dirname(__DIR__, $level) . '/markup' . $subFolder . '/ssr/ssr.cjs',
		];


		$folders = array_filter($folders, function($folder) {
			return file_exists($folder);
		});

		$folders = array_values($folders);

		if(count($folders) === 0)
		{
			return null;
		}

		return array_shift($folders);
	}
}
