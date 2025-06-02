<?php

namespace Craft\User\Application\Entity;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\DatetimeField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\Type\DateTime;

class JUserSocialIdentityTable extends DataManager
{

	const FIELD_ID = 'ID';
	const FIELD_USER_ID = 'USER_ID';
	const FIELD_IDENTITY_ID = 'IDENTITY_ID';
	const FIELD_SOCIAL = 'SOCIAL';
	const FIELD_CREATED_AT = 'CREATED_AT';

	public static function getTableName()
	{
		return 'user_social_identities';
	}


	public static function getMap()
	{
		return [
			(new IntegerField(self::FIELD_ID))
				->configureTitle('ID')
				->configurePrimary(),

			(new IntegerField(self::FIELD_USER_ID))
				->configureTitle('ID пользователя')
				->configureRequired(),

			(new StringField(self::FIELD_IDENTITY_ID))
				->configureTitle('Идентификатор')
				->configureRequired(),

			(new StringField(self::FIELD_SOCIAL))
				->configureTitle('Соц. сеть')
				->configureRequired(),

			(new DatetimeField(self::FIELD_CREATED_AT))
				->configureDefaultValue(new DateTime()),
		];
	}
}