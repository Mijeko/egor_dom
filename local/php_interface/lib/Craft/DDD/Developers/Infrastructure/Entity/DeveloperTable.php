<?php

namespace Craft\DDD\Developers\Infrastructure\Entity;

use Bitrix\Main\Entity\StringField;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\BooleanField;
use Bitrix\Main\ORM\Fields\IntegerField;

class DeveloperTable extends DataManager
{
	const F_ID = 'ID';
	const F_ACTIVE = 'ACTIVE';
	const F_NAME = 'NAME';


	const ACTIVE_Y = 'Y';
	const ACTIVE_N = 'N';

	public static function getMap()
	{
		return [
			(new IntegerField(self::F_ID))
				->configureTitle('ID')
				->configurePrimary(),
			(new BooleanField(self::F_ACTIVE))
				->configureTitle('Активность')
				->configureDefaultValue(self::ACTIVE_Y),
			(new StringField(self::F_NAME))
				->configureTitle('Название застройщика')
				->configureRequired(),
		];
	}

	public static function getObjectClass()
	{
		return Developer::class;
	}
}