<?php

namespace Craft\Bitrix\Service;

class CheckEmptyPersonalMobile
{
	public static function handle($arFields): bool
	{
		if(mb_strlen($arFields["PERSONAL_MOBILE"]) <= 0)
		{
			global $APPLICATION;
			$APPLICATION->throwException("Пожалуйста, укажите мобильный телефон пользователя.");
			return false;
		}

		return true;
	}
}