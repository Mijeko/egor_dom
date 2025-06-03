<?php

use Bitrix\Main\Page\Asset;
use Craft\Dto\ManifestBlockDto;

class CraftViteComponent extends CBitrixComponent
{

	public function onPrepareComponentParams($arParams)
	{
		$arParams['SOURCE'] = $arParams['SOURCE'] ?? 'index.html';
		$arParams['ID'] = $arParams['ID'] ?? 'app';

		return $arParams;
	}

	public function executeComponent()
	{

		try
		{
			$this->modules(['craft.core']);
			$this->readManifest($this->arParams['SOURCE']);
			$this->includeComponentTemplate();
		} catch(Exception $e)
		{
			return;
		}
	}

	protected function modules(array $modules): void
	{
		foreach($modules as $module)
		{
			if(!\Bitrix\Main\Loader::includeModule($module))
			{
				throw new Exception('Module "' . $module . '" not found');
			}
		}
	}

	protected function viteDir(): string
	{
		return '/local/markup/dom-egor';
	}

	protected function getManifestPath(): string
	{
		return $this->viteDir() . '/dist/.vite/manifest.json';
	}


	protected function readManifest(string $blockKey): void
	{
		$manifestBlock = $this->readManifestBlock($blockKey);

		if(!$manifestBlock)
		{
			throw new Exception('Manifest not found');
		}

		//		\Bitrix\Main\Diag\Debug::dump($manifestBlock);

		$this->loadManifestBlock($manifestBlock);
	}

	protected function loadManifestBlock(ManifestBlockDto $manifestBlock): void
	{
		$assets = Asset::getInstance();

		if($manifestBlock->getImports())
		{
			foreach($manifestBlock->getImports() as $import)
			{
				$this->readManifest($import);
			}
		}

		if($manifestBlock->getFile())
		{
			$assets->addString('<script type="module" src="' . $this->viteDir() . '/dist/' . $manifestBlock->getFile() . '"></script>');
		}


		if($manifestBlock->getCss())
		{
			foreach($manifestBlock->getCss() as $css)
			{
				$assets->addCss($this->viteDir() . '/dist/' . $css);
			}
		}

		$this->includeAssets($manifestBlock);


	}

	protected function readManifestBlock(string $blockKey): ?ManifestBlockDto
	{
		if(!file_exists($_SERVER['DOCUMENT_ROOT'] . $this->getManifestPath()))
		{
			\Bitrix\Main\Diag\Debug::dump('Manifest file not found');
			return null;
		}

		$rawManifest = file_get_contents($_SERVER['DOCUMENT_ROOT'] . $this->getManifestPath());

		$manifest = json_decode($rawManifest, true);

		if(!$manifest[$blockKey])
		{
			\Bitrix\Main\Diag\Debug::dump('Source not found');
			return null;
		}

		return ManifestBlockDto::fromArray($manifest[$blockKey]);
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
			if($asset->isFont())
			{
				$assets->addString('<link rel="preload" as="font" type="font/' . $asset->getExtension() . '" href="' . $this->viteDir() . '/dist/' . $asset->getFile() .
					'" crossorigin="anonymous">');
			}
		}
	}
}