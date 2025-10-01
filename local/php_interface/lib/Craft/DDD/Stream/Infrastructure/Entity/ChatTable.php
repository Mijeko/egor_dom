<?php

namespace Craft\DDD\Stream\Infrastructure\Entity;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\BooleanField;
use Bitrix\Main\ORM\Fields\IntegerField;

class ChatTable extends DataManager
{

	const F_ID = 'ID';
	const F_ACTIVE = 'ACTIVE';

	const ACTIVE_Y = 'Y';
	const ACTIVE_N = 'N';

	public static function getTableName()
	{
		return 'craft_chat';
	}

	public static function getMap()
	{
		return [
			(new IntegerField(self::F_ID))
				->configurePrimary(),
			(new BooleanField(self::F_ACTIVE))
				->configureDefaultValue(self::ACTIVE_Y)
				->configureStorageValues(self::ACTIVE_N, self::ACTIVE_Y),
		];
	}

	public static function getObjectClass()
	{
		return Chat::class;
	}
}