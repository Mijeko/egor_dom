<?php

namespace Craft\Model;

use Bitrix\Main\UserTable;

class CraftUserTable extends UserTable
{
	public static function getMap()
	{
		$map = parent::getMap();
		return $map;
	}
}