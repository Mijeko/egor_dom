<?php

class CraftUserProfile extends CBitrixComponent
{
	public function onPrepareComponentParams($arParams)
	{
		return $arParams;
	}

	public function executeComponent()
	{
		$arDefaultUrlTemplates404 = [
			'main'    => 'main.php',
			'element' => '#ELEMENT_ID#.php',
		];
		$arDefaultVariableAliases404 = [];
		$arDefaultVariableAliases = [];
		$arComponentVariables = ['IBLOCK_ID', 'ELEMENT_ID'];
		$SEF_FOLDER = '';
		$arUrlTemplates = [];
		if($this->arParams['SEF_MODE'] == 'Y')
		{

			$arVariables = [];
			$arUrlTemplates = CComponentEngine::MakeComponentUrlTemplates(
				$arDefaultUrlTemplates404,
				$this->arParams['SEF_URL_TEMPLATES']
			);

			$arVariableAliases = CComponentEngine::MakeComponentVariableAliases(
				$arDefaultVariableAliases404,
				$this->arParams['VARIABLE_ALIASES']
			);
			$componentPage = CComponentEngine::ParseComponentPath(
				$this->arParams['SEF_FOLDER'],
				$arUrlTemplates,
				$arVariables
			);
			if(strlen($componentPage) <= 0)
			{
				$componentPage = 'list';
			}
			CComponentEngine::InitComponentVariables(
				$componentPage,
				$arComponentVariables,
				$arVariableAliases,
				$arVariables);
			$SEF_FOLDER = $this->arParams['SEF_FOLDER'];
		} else
		{
			$arVariables = [];
			$arVariableAliases = CComponentEngine::MakeComponentVariableAliases(
				$arDefaultVariableAliases,
				$this->arParams['VARIABLE_ALIASES']
			);

			CComponentEngine::InitComponentVariables(
				false,
				$arComponentVariables,
				$arVariableAliases,
				$arVariables
			);
			$componentPage = '';

			if(intval($arVariables['ELEMENT_ID']) > 0)
			{
				$componentPage = 'element';
			} else
			{
				$componentPage = 'main';
			}
		}
		$this->arResult = [
			'FOLDER'        => $SEF_FOLDER,
			'URL_TEMPLATES' => $arUrlTemplates,
			'VARIABLES'     => $arVariables,
			'ALIASES'       => $arVariableAliases,
		];


		$this->includeComponentTemplate($componentPage);
	}
}