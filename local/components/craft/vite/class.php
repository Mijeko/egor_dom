<?php

use Bitrix\Main\Page\Asset;
use Craft\Dto\ViteManifestAssetsDto;

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
		$assets = $this->readManifest();

		if(!$assets)
		{
			return;
		}

		$this->includeAssets($assets);

		$this->includeComponentTemplate();
	}

	protected function getManifestPath(): string
	{
		return '/local/markup/vite/dist/.vite/manifest.json';
	}


	protected function readManifest(): ?ViteManifestAssetsDto
	{
		if(!file_exists($_SERVER['DOCUMENT_ROOT'] . $this->getManifestPath()))
		{
			return null;
		}

		$rawManifest = file_get_contents($_SERVER['DOCUMENT_ROOT'] . $this->getManifestPath());

		$manifest = json_decode($rawManifest, true);

		if(!$manifest[$this->arParams['SOURCE']])
		{
			return null;
		}

		$manifestBlock = $manifest[$this->arParams['SOURCE']];

		$viteManifestAssetsDto = new ViteManifestAssetsDto();

		if($manifestBlock['file'])
		{
			$viteManifestAssetsDto->addJs($manifestBlock['file']);
		}

		if($manifestBlock['css'] && is_array($manifestBlock['css']))
		{
			foreach($manifestBlock['css'] as $css)
			{
				$viteManifestAssetsDto->addCss($css);
			}

		}

		return $viteManifestAssetsDto;
	}

	protected function includeAssets(ViteManifestAssetsDto $assetsData): void
	{
		$assets = Asset::getInstance();

		foreach($assetsData->getJsFiles() as $jsFile)
		{
			$assets->addJs('/local/markup/vite/dist/' . $jsFile);
		}

		foreach($assetsData->getCssFiles() as $cssFile)
		{
			$assets->addCss('/local/markup/vite/dist/' . $cssFile);
		}
	}
}