<?php

namespace Craft\Bitrix\EventHandlers;

use Craft\Bitrix\Service\CheckEmptyPersonalMobile;

class OnBeforeUserUpdateHandler
{
	public static function handle(array &$arFields): bool
	{
		if(!CheckEmptyPersonalMobile::handle($arFields))
		{
			return false;
		}

		return true;
	}
}