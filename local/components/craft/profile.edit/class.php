<?php

class CraftProfileEditComponent extends CBitrixComponent
{
	public function onPrepareComponentParams($arParams)
	{
		return $arParams;
	}

	public function executeComponent()
	{
		$this->includeComponentTemplate();
	}

}