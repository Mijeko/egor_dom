<?php

namespace Craft\DDD\Objects\Infrastructure\Entity;

use Bitrix\Main\Entity\BooleanField;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;

class BuildObjectTable extends DataManager
{

	const F_ID = 'ID';
	const F_ACTIVE = 'ACTIVE';
	const F_SORT = 'SORT';
	const F_NAME = 'NAME';


	const ACTIVE_Y = 'Y';
	const ACTIVE_N = 'N';

	public static function getMap()
	{
		return [
			(new IntegerField(self::F_ID))
				->configureTitle('ID')
				->configureRequired()
				->configurePrimary(),
			(new BooleanField(self::F_ACTIVE))
				->configureTitle('Активность')
				->configureDefaultValue(self::ACTIVE_Y),
			(new IntegerField(self::F_SORT))
				->configureTitle('Сортировка')
				->configureDefaultValue(500),
			(new StringField(self::F_NAME))
				->configureTitle('Название объекта')
				->configureRequired(),
		];
	}

	public static function getObjectClass()
	{
		return BuildObject::class;
	}
}