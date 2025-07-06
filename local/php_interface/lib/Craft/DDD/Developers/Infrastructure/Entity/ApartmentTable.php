<?php

namespace Craft\DDD\Developers\Infrastructure\Entity;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\BooleanField;
use Bitrix\Main\ORM\Fields\DatetimeField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Query\Join;
use Bitrix\Main\Type\DateTime;
use Craft\DDD\Developers\Infrastructure\Entity\BuildObjectTable;

class ApartmentTable extends DataManager
{

	const F_ID = 'ID';
	const F_NAME = 'NAME';
	const F_ACTIVE = 'ACTIVE';
	const F_SORT = 'SORT';
	const F_CODE = 'CODE';
	const F_PRICE = 'PRICE';
	const F_ROOMS = 'ROOMS';
	const F_FLOOR = 'FLOOR';
	const F_DESCRIPTION = 'DESCRIPTION';
	const F_RENOVATION = 'RENOVATION';
	const F_BUILT_YEAR = 'BUILT_YEAR';
	const F_BUILDING_STATE = 'BUILDING_STATE';
	const F_MORTGAGE = 'MORTGAGE';
	const F_PARKING = 'PARKING';
	const F_PLAN_IMAGE = 'PLAN_IMAGE';
	const F_AREA = 'AREA';
	const F_GALLERY = 'GALLERY';
	const F_BATHROOM_UNIT = 'BATHROOM_UNIT';
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
			(new StringField(self::F_CODE))
				->configureTitle('Символьный код')
				->configureRequired(),
			(new StringField(self::F_DESCRIPTION))
				->configureTitle('Описание')
				->configureRequired(),
			(new BooleanField(self::F_ACTIVE))
				->configureTitle('Активность')
				->configureDefaultValue(self::ACTIVE_Y)
				->configureValues(self::ACTIVE_N, self::ACTIVE_Y),
			(new IntegerField(self::F_SORT))
				->configureTitle('Сортировка')
				->configureDefaultValue(500),
			(new IntegerField(self::F_ROOMS))
				->configureTitle('Количество комнат'),
			(new IntegerField(self::F_FLOOR))
				->configureTitle('Этаж'),
			(new IntegerField(self::F_PRICE))
				->configureRequired()
				->configureTitle('Цена квартиры'),
			(new StringField(self::F_PLAN_IMAGE))
				->configureTitle('План квартиры'),
			(new StringField(self::F_GALLERY))
				->configureTitle('Изображения'),
			(new StringField(self::F_RENOVATION))
				->configureTitle('Отделка'),
			(new IntegerField(self::F_BUILT_YEAR))
				->configureTitle('Год постройки'),
			(new StringField(self::F_BUILDING_STATE))
				->configureTitle('Статус постройки'),
			(new StringField(self::F_MORTGAGE))
				->configureTitle('Ипотека'),
			(new StringField(self::F_PARKING))
				->configureTitle('Парковка'),
			(new StringField(self::F_AREA))
				->configureTitle('Площадь квартиры'),
			(new StringField(self::F_BATHROOM_UNIT))
				->configureTitle('Раздельный санузел'),
			(new DatetimeField(self::F_CREATED_AT))
				->configureTitle('Дата создания')
				->configureDefaultValue(new DateTime()),
			(new DatetimeField(self::F_UPDATED_AT))
				->configureTitle('Дата обновления')
				->configureDefaultValue(new DateTime()),

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