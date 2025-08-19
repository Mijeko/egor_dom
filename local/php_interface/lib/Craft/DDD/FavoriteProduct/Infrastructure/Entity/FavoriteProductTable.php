<?php

namespace Craft\DDD\FavoriteProduct\Infrastructure\Entity;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;

class FavoriteProductTable extends DataManager
{

	const F_PRODUCT_ID = 'PRODUCT_ID';
	const F_USER_ID = 'USER_ID';

	public static function getTableName(): string
	{
		return 'favorite_product';
	}

	public static function getMap(): array
	{
		return [
			(new IntegerField(self::F_PRODUCT_ID))
				->configurePrimary(),
			(new IntegerField(self::F_USER_ID))
				->configurePrimary(),
		];
	}

	public static function getObjectClass()
	{
		return FavoriteProduct::class;
	}
}