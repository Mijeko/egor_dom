<?php

namespace Craft\Bitrix\EventHandlers;

use Craft\Bitrix\CheckEmptyPersonalMobile;

class OnBeforeUserAddHandler
{
	public static function handle(&$arFields)
	{
		if(!CheckEmptyPersonalMobile::handle($arFields))
		{
			return false;
		}

		return true;
	}
}