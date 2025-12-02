<?php

use Craft\Core\Component\AjaxComponent;
use Craft\Core\Rest\ResponseBx;
use Craft\Dto\MenuItemDto;

class CraftMenuComponent extends AjaxComponent
{
	function componentNamespace(): string
	{
		return 'craftMenuComponent';
	}

	protected function validate(array $postData): void
	{
	}

	protected function work(array $formData): void
	{
		try
		{
			$typeMenu = $formData['typeMenu'];
			$dir = $formData['dir'];

			$componentPath = CComponentEngine::MakeComponentPath('craft:menu');
			$menu = new CMenu($typeMenu);
			$menu->Init($dir, true, $componentPath . "/stub.php");
			$menu->RecalcMenu();


			$this->getChildMenuRecursive(
				$menu->arMenu,
				$arResult,
				[
					$typeMenu,
					'left',
				],
				true,
				$menu->template,
				$currentLevel = 1,
				5,
				false,
				false,
				false
			);

			$menuDto = array_map(function(array $item) {

				$title = $item[0] ?? null;
				$url = $item[1] ?? null;
				$params = $item[3] ?? [];

				return new MenuItemDto(
					$title,
					$url,
					$params
				);

			}, $menu->arMenu);

			ResponseBx::success($menuDto);

		} catch(Exception $e)
		{
		}

	}

	protected function modules(): ?array
	{
		return [];
	}

	protected function loadData(): void
	{
	}

	public function loadServices(): void
	{
	}

	protected function getChildMenuRecursive(&$arMenu, &$arResult, $menuType, $use_ext, $menuTemplate, $currentLevel, $maxLevel, $bMultiSelect, $bCheckSelected, $parentItem)
	{
		if($currentLevel > $maxLevel)
			return;

		for($menuIndex = 0, $menuCount = count($arMenu); $menuIndex < $menuCount; $menuIndex++)
		{
			//Menu from iblock (bitrix:menu.sections)
			$arMenu[$menuIndex]["CHAIN"] = (is_array($parentItem) && !empty($parentItem["CHAIN"]) ? $parentItem["CHAIN"] : []);
			$arMenu[$menuIndex]["CHAIN"][] = $arMenu[$menuIndex]["TEXT"];

			if(is_array($arMenu[$menuIndex]["PARAMS"]) && isset($arMenu[$menuIndex]["PARAMS"]["FROM_IBLOCK"]))
			{
				$iblockSectionLevel = intval($arMenu[$menuIndex]["PARAMS"]["DEPTH_LEVEL"]);
				if($currentLevel > 1)
					$iblockSectionLevel = $iblockSectionLevel + $currentLevel - 1;

				$arResult[] = $arMenu[$menuIndex] + ["DEPTH_LEVEL" => $iblockSectionLevel, "IS_PARENT" => $arMenu[$menuIndex]["PARAMS"]["IS_PARENT"]];
				continue;
			}

			//Menu from files
			$subMenuExists = false;
			if($currentLevel < $maxLevel)
			{
				//directory link only
				$bDir = false;
				if(!preg_match("'^(([a-z]+://)|mailto:|javascript:)'i", $arMenu[$menuIndex]["LINK"]))
				{
					if(str_ends_with($arMenu[$menuIndex]["LINK"], "/"))
					{
						if(!$parentItem || $parentItem['LINK'] !== $arMenu[$menuIndex]["LINK"])
						{
							$bDir = true;
						}
					}
				}
				if($bDir)
				{
					$type = $menuType; // public method compatibility
					if(is_array($type))
					{
						$type = $menuType[$currentLevel] ?? $menuType[count($menuType) - 1];
					}

					$menu = new CMenu($type);
					$menu->disableDebug();
					$success = $menu->Init($arMenu[$menuIndex]["LINK"], $use_ext, $menuTemplate, $onlyCurrentDir = true);
					$subMenuExists = ($success && !empty($menu->arMenu));

					if($subMenuExists)
					{
						$menu->RecalcMenu($bMultiSelect, $bCheckSelected);

						$arResult[] = $arMenu[$menuIndex] + ["DEPTH_LEVEL" => $currentLevel, "IS_PARENT" => (!empty($menu->arMenu))];

						if($arMenu[$menuIndex]["SELECTED"])
						{
							$arResult["menuType"] = $type;
							$arResult["menuDir"] = $arMenu[$menuIndex]["LINK"];
						}

						if(!empty($menu->arMenu))
							$this->GetChildMenuRecursive($menu->arMenu, $arResult, $menuType, $use_ext, $menuTemplate, $currentLevel + 1, $maxLevel, $bMultiSelect, $bCheckSelected, $arMenu[$menuIndex]);
					}
				}
			}

			if(!$subMenuExists)
				$arResult[] = $arMenu[$menuIndex] + ["DEPTH_LEVEL" => $currentLevel, "IS_PARENT" => false];
		}
	}
}