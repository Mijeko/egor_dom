<?php

namespace Craft\DDD\City\Infrastructure\Entity;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\BooleanField;
use Bitrix\Main\ORM\Fields\DatetimeField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\Relations\OneToMany;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\Type\DateTime;
use Craft\DDD\Developers\Infrastructure\Entity\BuildObjectTable;
use Craft\DDD\Developers\Infrastructure\Entity\DeveloperTable;

class CityTable extends DataManager
{

	const F_ID = 'ID';
	const F_NAME = 'NAME';
	const F_CODE = 'CODE';
	const F_ACTIVE = 'ACTIVE';
	const F_IS_DEFAULT = 'IS_DEFAULT';
	const F_SORT = 'SORT';
	const F_CREATED_AT = 'CREATED_AT';
	const F_UPDATED_AT = 'UPDATED_AT';

	const ACTIVE_Y = 'Y';
	const ACTIVE_N = 'N';

	const DEFAULT_Y = 'Y';
	const DEFAULT_N = 'N';

	const R_BUILD_OBJECTS = 'BUILD_OBJECTS';
	const R_DEVELOPERS = 'DEVELOPERS';

	public static function getTableName()
	{
		return 'craft_city';
	}

	public static function getMap()
	{
		return [
			(new IntegerField(self::F_ID))
				->configureTitle('ID')
				->configurePrimary(),
			(new StringField(self::F_NAME))
				->configureRequired()
				->configureTitle('Название'),
			(new StringField(self::F_CODE))
				->configureRequired()
				->configureTitle('Символьный код'),
			(new BooleanField(self::F_ACTIVE))
				->configureValues(self::ACTIVE_N, self::ACTIVE_Y)
				->configureDefaultValue(self::ACTIVE_Y)
				->configureRequired()
				->configureTitle('Активность'),
			(new BooleanField(self::F_IS_DEFAULT))
				->configureValues(self::DEFAULT_N, self::DEFAULT_Y)
				->configureDefaultValue(self::DEFAULT_Y)
				->configureTitle('Город по умолчанию'),
			(new IntegerField(self::F_SORT))
				->configureDefaultValue(500)
				->configureTitle('Сортировка'),
			// more fields
			(new DatetimeField(self::F_CREATED_AT))
				->configureTitle('Дата создания')
				->configureDefaultValue(new DateTime()),
			(new DatetimeField(self::F_UPDATED_AT))
				->configureTitle('Дата обновления')
				->configureDefaultValue(new DateTime()),


			(new OneToMany(
				self::R_BUILD_OBJECTS,
				BuildObjectTable::class,
				BuildObjectTable::R_CITY
			)),

			(new OneToMany(
				self::R_DEVELOPERS,
				DeveloperTable::class,
				DeveloperTable::R_CITY
			)),
		];
	}

	public static function getObjectClass()
	{
		return City::class;
	}
}