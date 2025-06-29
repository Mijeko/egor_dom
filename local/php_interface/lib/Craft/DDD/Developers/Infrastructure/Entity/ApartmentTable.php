<?php

namespace Craft\DDD\Developers\Infrastructure\Entity;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\BooleanField;
use Bitrix\Main\ORM\Fields\DatetimeField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Query\Join;
use Craft\DDD\Developers\Infrastructure\Entity\Apartment;
use Craft\DDD\Objects\Infrastructure\Entity\BuildObjectTable;

class ApartmentTable extends DataManager
{

	const F_ID = 'ID';
	const F_NAME = 'NAME';
	const F_ACTIVE = 'ACTIVE';
	const F_SORT = 'SORT';
	const F_CODE = 'CODE';
	const F_PRICE = 'PRICE';
	const F_PLAN_IMAGE_ID = 'PLAN_IMAGE_ID';
	const F_CREATED_AT = 'CREATED_AT';
	const F_UPDATED_AT = 'UPDATED_AT';


	const F_BUILD_OBJECT_ID = 'BUILD_OBJECT_ID';

	const R_BUILD_OBJECT = 'BUILD_OBJECT';

	const ACTIVE_Y = 'Y';
	const ACTIVE_N = 'N';

	public static function getTableName()
	{
		return 'craft_apartment';
	}

	public static function getMap()
	{
		return [
			(new IntegerField(self::F_ID))
				->configureTitle('ID')
				->configurePrimary()
				->configureAutocomplete(),
			(new StringField(self::F_NAME))
				->configureTitle('Название')
				->configureRequired(),
			(new BooleanField(self::F_ACTIVE))
				->configureTitle('Активность')
				->configureDefaultValue(self::ACTIVE_Y)
				->configureValues(self::ACTIVE_N, self::ACTIVE_Y),
			(new IntegerField(self::F_SORT))
				->configureTitle('Сортировка')
				->configureDefaultValue(500),
			(new StringField(self::F_CODE))
				->configureTitle('Символьный код')
				->configureRequired(),
			(new IntegerField(self::F_PRICE))
				->configureRequired()
				->configureTitle('Цена квартиры'),
			(new IntegerField(self::F_PLAN_IMAGE_ID))
				->configureTitle('План квартиры'),
			(new DatetimeField(self::F_CREATED_AT))
				->configureTitle('Дата создания'),
			(new DatetimeField(self::F_UPDATED_AT))
				->configureTitle('Дата обновления'),

			(new IntegerField(self::F_BUILD_OBJECT_ID))
				->configureRequired()
				->configureTitle('Объект недвижимости'),


			(new Reference(
				self::R_BUILD_OBJECT,
				BuildObjectTable::class,
				Join::on('this.' . self::F_BUILD_OBJECT_ID, 'ref.' . BuildObjectTable::F_ID)
			)),

		];
	}

	public static function getObjectClass()
	{
		return Apartment::class;
	}
}