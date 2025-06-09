<?php

namespace Craft\DDD\Objects\Infrastructure\Entity;

use Bitrix\Main\Entity\BooleanField;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\DatetimeField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\Type\DateTime;

class BuildObjectTable extends DataManager
{

	const F_ID = 'ID';
	const F_DEVELOPER_ID = 'DEVELOPER_ID';
	const F_PICTURE_ID = 'PICTURE_ID';
	const F_ACTIVE = 'ACTIVE';
	const F_SORT = 'SORT';
	const F_NAME = 'NAME';
	const F_CREATED_AT = 'CREATED_AT';
	const F_UPDATED_AT = 'UPDATED_AT';


	const ACTIVE_Y = 'Y';
	const ACTIVE_N = 'N';

	public static function getTableName()
	{
		return 'craft_build_objects';
	}

	public static function getMap()
	{
		return [
			(new IntegerField(self::F_ID))
				->configureTitle('ID')
				->configureAutocomplete()
				->configurePrimary(),
			(new IntegerField(self::F_DEVELOPER_ID))
				->configureTitle('ID застройщик')
				->configureRequired(),
			(new IntegerField(self::F_PICTURE_ID))
				->configureTitle('ID картинки'),
			(new BooleanField(self::F_ACTIVE))
				->configureTitle('Активность')
				->configureDefaultValue(self::ACTIVE_Y)
				->configureValues(self::ACTIVE_N, self::ACTIVE_Y),
			(new IntegerField(self::F_SORT))
				->configureTitle('Сортировка')
				->configureDefaultValue(500),
			(new StringField(self::F_NAME))
				->configureTitle('Название объекта')
				->configureRequired(),
			(new DatetimeField(self::F_CREATED_AT))
				->configureTitle('Дата создания')
				->configureDefaultValue(new DateTime()),
			(new DatetimeField(self::F_UPDATED_AT))
				->configureDefaultValue(new DateTime()),
		];
	}

	public static function getObjectClass()
	{
		return BuildObject::class;
	}
}