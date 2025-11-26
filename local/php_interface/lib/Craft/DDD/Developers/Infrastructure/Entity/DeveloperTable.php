<?php

namespace Craft\DDD\Developers\Infrastructure\Entity;

use Bitrix\Main\Entity\StringField;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\BooleanField;
use Bitrix\Main\ORM\Fields\DatetimeField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\Relations\OneToMany;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Query\Join;
use Bitrix\Main\Type\DateTime;
use Craft\DDD\City\Infrastructure\Entity\CityTable;

class DeveloperTable extends DataManager
{
	const F_ID = 'ID';
	const F_ACTIVE = 'ACTIVE';
	const F_NAME = 'NAME';
	const F_DESCRIPTION = 'DESCRIPTION';
	const F_SORT = 'SORT';
	const F_SETTINGS = 'SETTINGS';
	const F_PICTURE_ID = 'PICTURE_ID';
	const F_CITY_ID = 'CITY_ID';
	const F_CREATED_AT = 'CREATED_AT';
	const F_UPDATED_AT = 'UPDATED_AT';


	const R_BUILD_OBJECTS = 'BUILD_OBJECTS';
	const R_CITY = 'CITY';


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
			(new StringField(self::F_DESCRIPTION))
				->configureTitle('Описание'),
			(new IntegerField(self::F_SORT))
				->configureTitle('Сортировка')
				->configureDefaultValue(500),
			(new IntegerField(self::F_PICTURE_ID))
				->configureTitle('Изображение'),
			(new StringField(self::F_SETTINGS))
				->configureTitle('Настройки'),
			(new IntegerField(self::F_CITY_ID))
				->configureTitle('ID города')
				->configureRequired(),
			(new DatetimeField(self::F_CREATED_AT))
				->configureDefaultValue(new DateTime()),
			(new DatetimeField(self::F_UPDATED_AT))
				->configureDefaultValue(new DateTime()),


			(new OneToMany(
				self::R_BUILD_OBJECTS,
				BuildObjectTable::class,
				BuildObjectTable::R_DEVELOPER
			))
				->configureJoinType('left'),

			(new Reference(
				self::R_CITY,
				CityTable::class,
				Join::on('this.' . self::F_CITY_ID, 'ref.' . CityTable::F_ID)
			))
				->configureJoinType('left'),
		];
	}

	public static function getObjectClass()
	{
		return Developer::class;
	}
}