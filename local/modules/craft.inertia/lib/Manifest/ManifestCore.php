<?php

namespace Craft\Inertia\Manifest;

use Bitrix\Main\Diag\Debug;
use Bitrix\Main\Page\Asset;
use Craft\Inertia\Manifest\Dto\ManifestBlockDto;
use Craft\Inertia\Manifest\Dto\ManifestDto;
use Craft\Inertia\Support\Config;

class ManifestCore
{
	protected static $instance;

	protected ?ManifestDto $manifestList;
	protected ?Asset $assets;
	protected Config $config;

	public function __construct()
	{
		$this->assets = Asset::getInstance();
		$this->config = new Config();
	}

	/**
	 * @return Config
	 */
	public function getConfig(): Config
	{
		return $this->config;
	}

	protected function viteDir(): string
	{
		return '/local/markup/' . $this->config->get('build.dir');
	}

	protected function getManifestPath(): string
	{
		return $_SERVER['DOCUMENT_ROOT'] . $this->source() . '/.vite/manifest.json';
	}

	protected function source(): string
	{
		return $this->viteDir() . '/public/build';
	}


	public static function instance(): ManifestCore
	{
		if(is_null(static::$instance))
		{
			static::$instance = new ManifestCore();
		}

		return self::$instance;
	}

	public function load(): void
	{
		try
		{
			$this->read();
			$this->loadCore();
		} catch(\Exception $e)
		{
			echo $e->getMessage();
		}
	}


	protected function read(): void
	{
		if(empty($this->manifestList))
		{
			$content = file_get_contents($this->getManifestPath());
			if(!$content || mb_strlen($content) == 0)
			{
				throw new \Exception('Manifest file is empty');
			}

			$manifestJson = json_decode($content, true);
			$this->manifestList = ManifestDto::fromJson($manifestJson);
		}
	}


	protected function includeAssets(ManifestBlockDto $manifestBlock): void
	{
		if(!$manifestBlock->getAssets())
		{
			return;
		}

		$assets = Asset::getInstance();

		foreach($manifestBlock->getAssets() as $asset)
		{
			if(is_object($asset) && $asset->isFont())
			{
				$assets->addString('<link rel="preload" as="font" type="font/' . $asset->getExtension() . '" href="' . $this->source() . $asset->getFile() . '" crossorigin="anonymous">');
			}
		}
	}


	protected function loadManifest(ManifestBlockDto $manifest): void
	{
		if($manifest->getImports())
		{
			foreach($manifest->getImports() as $import)
			{
				$importManifestBlock = $this->findManifestBlock($import);
				if($importManifestBlock)
				{
					$this->loadManifest($importManifestBlock);
				}
			}
		}

		if($manifest->getFile() && !$manifest->isCss())
		{
			if($manifest->getIsDynamicEntry())
			{
				$this->assets->addString('<script type="module" src="' . $this->source() . '/' . $manifest->getFile() . '"></script>');

			} else
			{
				$this->assets->addJs($this->source() . '/' . $manifest->getFile());
			}
		}

		if($manifest->getCss())
		{
			foreach($manifest->getCss() as $css)
			{
				$this->assets->addCss($this->source() . '/' . $css);
			}
		}

		if($manifest->isCss())
		{
			$this->assets->addCss($this->source() . '/' . $manifest->getFile());
		}

		$this->includeAssets($manifest);
	}


	protected function loadCore(): void
	{
		$js = $this->manifestList->getCoreJs();
		if($js)
		{
			$this->loadManifest($js);
		}

		$css = $this->manifestList->getCoreCss();
		if($css)
		{
			$this->loadManifest($css);
		}
	}


	protected function findManifestBlock(string $blockKey): ?ManifestBlockDto
	{
		$manifest = $this->manifestList->getBlockByName($blockKey);
		if(!$manifest)
		{
			return null;
		}

		return $manifest;
	}
}