<?php

class CraftModalComponent extends CBitrixComponent
{

	public function onPrepareComponentParams($arParams)
	{
		$arParams['MESSAGE'] = $arParams['MESSAGE'] ?: null;

		return $arParams;
	}

	public function executeComponent()
	{
		ob_start();
		$this->includeComponentTemplate();

		return ob_get_clean();
	}
}