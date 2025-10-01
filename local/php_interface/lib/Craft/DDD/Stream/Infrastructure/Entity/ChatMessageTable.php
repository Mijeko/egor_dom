<?php

namespace Craft\DDD\Stream\Infrastructure\Entity;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;

class ChatMessageTable extends DataManager
{
	const F_ID = 'ID';
	const F_CHAT_ID = 'CHAT_ID';
	const F_AUTHOR_USER_ID = 'AUTHOR_USER_ID';
	const F_TEXT = 'TEXT';

	public static function getTableName()
	{
		return 'craft_chat_message';
	}

	public static function getMap()
	{
		return [
			(new IntegerField(self::F_ID))
				->configurePrimary(),
			(new IntegerField(self::F_CHAT_ID)),
			(new IntegerField(self::F_AUTHOR_USER_ID)),
			(new StringField(self::F_TEXT)),
		];
	}

	public static function getObjectClass()
	{
		return ChatMessage::class;
	}
}