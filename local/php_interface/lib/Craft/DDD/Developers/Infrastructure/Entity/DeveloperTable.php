<?php

namespace Craft\DDD\Developers\Infrastructure\Entity;

use Bitrix\Main\Entity\StringField;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\BooleanField;
use Bitrix\Main\ORM\Fields\DatetimeField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\Type\DateTime;

class DeveloperTable extends DataManager
{
	const F_ID = 'ID';
	const F_ACTIVE = 'ACTIVE';
	const F_NAME = 'NAME';
	const F_SORT = 'SORT';
	const F_IMPORT_SETTINGS = 'IMPORT_SETTINGS';
	const F_PICTURE_ID = 'PICTURE_ID';
	const F_CREATED_AT = 'CREATED_AT';
	const F_UPDATED_AT = 'UPDATED_AT';


	const ACTIVE_Y = 'Y';
	const ACTIVE_N = 'N';

	public static function getTableName()
	{
		return 'craft_developers';
	}

	public static function getMap()
	{
		return [
			(new IntegerField(self::F_ID))
				->configureTitle('ID')
				->configurePrimary(),
			(new BooleanField(self::F_ACTIVE))
				->configureTitle('Активность')
				->configureDefaultValue(self::ACTIVE_Y)
				->configureValues(self::ACTIVE_N, self::ACTIVE_Y),
			(new StringField(self::F_NAME))
				->configureTitle('Название застройщика')
				->configureRequired(),
			(new IntegerField(self::F_SORT))
				->configureTitle('Сортировка')
				->configureDefaultValue(500),
			(new IntegerField(self::F_PICTURE_ID))
				->configureTitle('Изобращение'),
			(new StringField(self::F_IMPORT_SETTINGS))
				->configureTitle('Настройки импорта'),
			(new DatetimeField(self::F_CREATED_AT))
				->configureDefaultValue(new DateTime()),
			(new DatetimeField(self::F_UPDATED_AT))
				->configureDefaultValue(new DateTime()),
		];
	}

	public static function getObjectClass()
	{
		return Developer::class;
	}
}