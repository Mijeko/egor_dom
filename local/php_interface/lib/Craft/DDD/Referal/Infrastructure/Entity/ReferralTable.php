<?php

namespace Craft\DDD\Referal\Infrastructure\Entity;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\BooleanField;
use Bitrix\Main\ORM\Fields\DatetimeField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\Type\DateTime;

class ReferralTable extends DataManager
{

	const F_ID = 'ID';
	const F_USER_ID = 'USER_ID';
	const F_INVITED_USER_ID = 'INVITED_USER_ID';
	const F_CODE = 'CODE';
	const F_PHONE = 'PHONE';
	const F_ACTIVE = 'ACTIVE';
	const F_CREATED_AT = 'CREATED_AT';
	const F_UPDATED_AT = 'UPDATED_AT';


	const ACTIVE_Y = 'Y';
	const ACTIVE_N = 'N';

	public static function getTableName()
	{
		return 'craft_referral';
	}

	public static function getMap()
	{
		return [
			(new IntegerField(self::F_ID))
				->configureTitle('ID')
				->configurePrimary(),
			(new IntegerField(self::F_USER_ID))
				->configureTitle('ID пользователя')
				->configureRequired(),
			(new IntegerField(self::F_INVITED_USER_ID))
				->configureNullable()
				->configureTitle('ID пригласившего пользователя'),
			(new StringField(self::F_CODE))
				->configureTitle('Символьный код')
				->configureRequired(),
			(new StringField(self::F_PHONE))
				->configureTitle('Номер телефона пользователя')
				->configureRequired(),
			(new BooleanField(self::F_ACTIVE))
				->configureDefaultValue(self::ACTIVE_Y)
				->configureStorageValues(self::ACTIVE_N, self::ACTIVE_Y)
				->configureTitle('Активнось'),
			(new DatetimeField(self::F_CREATED_AT))
				->configureDefaultValue(new DateTime()),
			(new DatetimeField(self::F_UPDATED_AT)),
		];
	}

	public static function getObjectClass()
	{
		return Referral::class;
	}

}