<?php

namespace Craft\DDD\UserBehavior\Infrastructure\Entity;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\DatetimeField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\Type\DateTime;

class ViewedProductTable extends DataManager
{
	const F_PRODUCT_ID = 'PRODUCT_ID';
	const F_USER_ID = 'USER_ID';
	const F_NAME = 'NAME';
	const F_LINK = 'LINK';
	const F_CREATED_AT = 'CREATED_AT';

	public static function getTableName(): string
	{
		return 'craft_viewed_product';
	}

	public static function getMap(): array
	{
		return [
			(new IntegerField(self::F_PRODUCT_ID))
				->configurePrimary(),
			(new IntegerField(self::F_USER_ID))
				->configurePrimary(),
			(new StringField(self::F_NAME))
				->configureTitle('Название элемента')
				->configureRequired(),
			(new StringField(self::F_LINK))
				->configureTitle('Ссылка')
				->configureRequired(),
			(new DatetimeField(self::F_CREATED_AT))
				->configureTitle('Дата создания')
				->configureDefaultValue(new DateTime()),
		];
	}

	public static function getObjectClass()
	{
		return ViewedProduct::class;
	}
}