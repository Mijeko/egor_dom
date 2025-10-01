<?php

namespace Craft\DDD\Stream\Infrastructure\Entity;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;

class ChatMemberTable extends DataManager
{

	const F_ID = 'ID';
	const F_USER_ID = 'USER_ID';

	public static function getTableName()
	{
		return 'craft_chat_member';
	}

	public static function getMap()
	{
		return [
			(new IntegerField(self::F_ID))
				->configurePrimary(),
			(new IntegerField(self::F_USER_ID)),
		];
	}
}