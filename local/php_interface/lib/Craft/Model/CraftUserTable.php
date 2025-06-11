<?php

namespace Craft\Model;

use Bitrix\Main\UserTable;

class CraftUserTable extends UserTable
{

	const F_ID = 'ID';
	const F_LOGIN = 'LOGIN';
	const F_EMAIL = 'EMAIL';
	const F_PASSWORD = 'PASSWORD';
	const F_PERSONAL_PHONE = 'PERSONAL_PHONE';

	public static function getMap()
	{
		$map = parent::getMap();
		return $map;
	}

	public static function getObjectClass()
	{
		return CraftUser::class;
	}
}