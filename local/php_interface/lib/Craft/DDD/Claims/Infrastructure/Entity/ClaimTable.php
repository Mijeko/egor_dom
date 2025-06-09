<?php

namespace Craft\DDD\Claims\Infrastructure\Entity;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\DatetimeField;

class ClaimTable extends DataManager
{
	const F_ID = 'ID';
	const F_ACTIVE = 'ACTIVE';
	const F_NAME = 'NAME';
	const F_USER_ID = 'USER_ID';
	const F_BUILD_OBJECT_ID = 'BUILD_OBJECT_ID';
	const F_CREATED_AT = 'CREATED_AT';
	const F_UPDATED_AT = 'UPDATED_AT';


	const ACTIVE_Y = 'Y';
	const ACTIVE_N = 'N';

	public static function getTableName()
	{
		return 'craft_claims';
	}

	public static function getMap()
	{
		return [
			(new IntegerField(self::F_ID))
				->configurePrimary()
				->configureTitle('ID'),
			(new IntegerField(self::F_NAME))
				->configureTitle('Название'),
			(new IntegerField(self::F_USER_ID))
				->configureTitle('ID пользователя')
				->configureRequired(),
			(new IntegerField(self::F_BUILD_OBJECT_ID))
				->configureTitle('ID объекта')
				->configureRequired(),
			(new IntegerField(self::F_ACTIVE))
				->configureTitle('Активность')
				->configureDefaultValue(self::ACTIVE_Y),
			(new DatetimeField(self::F_CREATED_AT))
				->configureTitle('Дата создания'),
			(new DatetimeField(self::F_UPDATED_AT))
				->configureTitle('Дата обновления'),
		];
	}

	public static function getObjectClass()
	{
		return Claim::class;
	}
}