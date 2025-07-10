<?php

namespace Craft\DDD\Claims\Infrastructure\Entity;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\BooleanField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\DatetimeField;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Query\Join;
use Bitrix\Main\Type\DateTime;
use Craft\DDD\Developers\Infrastructure\Entity\ApartmentTable;
use Craft\Model\CraftUserTable;

class ClaimTable extends DataManager
{
	const F_ID = 'ID';
	const F_ACTIVE = 'ACTIVE';
	const F_NAME = 'NAME';
	const F_EMAIL = 'EMAIL';
	const F_CLIENT = 'CLIENT';
	const F_PHONE = 'PHONE';
	const F_INN = 'INN';
	const F_BIK = 'BIK';
	const F_OGRN = 'OGRN';
	const F_KPP = 'KPP';
	const F_CURR_ACC = 'CURR_ACC';
	const F_CORR_ACC = 'CORR_ACC';
	const F_LEGAL_ADDRESS = 'LEGAL_ADDRESS';
	const F_POST_ADDRESS = 'POST_ADDRESS';
	const F_BANK_NAME = 'BANK_NAME';
	const F_USER_ID = 'USER_ID';
	const F_APARTMENT_ID = 'APARTMENT_ID';
	const F_CREATED_AT = 'CREATED_AT';
	const F_UPDATED_AT = 'UPDATED_AT';


	const R_APARTMENT = 'APARTMENT';
	const R_USER = 'USER';

	const ACTIVE_Y = 'Y';
	const ACTIVE_N = 'N';

	public static function getTableName()
	{
		return 'craft_claims';
	}

	public static function getMap()
	{
		return [
			(new IntegerField(self::F_ID))
				->configurePrimary()
				->configureTitle('ID'),
			(new StringField(self::F_NAME))
				->configureTitle('Название'),
			(new StringField(self::F_EMAIL))
				->configureTitle('E-mail клиента'),
			(new StringField(self::F_PHONE))
				->configureTitle('Телефон клиента'),
			(new StringField(self::F_CLIENT))
				->configureTitle('ФИО клиента'),
			(new StringField(self::F_INN))
				->configureTitle('ИНН'),
			(new StringField(self::F_OGRN))
				->configureTitle('ОГРН'),
			(new StringField(self::F_KPP))
				->configureTitle('КПП'),
			(new StringField(self::F_BIK))
				->configureTitle('БИК'),
			(new StringField(self::F_CURR_ACC))
				->configureTitle('Расчетный счет'),
			(new StringField(self::F_CORR_ACC))
				->configureTitle('Корреспондентский счет'),
			(new StringField(self::F_LEGAL_ADDRESS))
				->configureTitle('Юридический адрес'),
			(new StringField(self::F_POST_ADDRESS))
				->configureTitle('Почтовый адрес'),
			(new StringField(self::F_BANK_NAME))
				->configureTitle('Имя банка'),
			(new IntegerField(self::F_USER_ID))
				->configureTitle('ID пользователя')
				->configureRequired(),
			(new IntegerField(self::F_APARTMENT_ID))
				->configureTitle('ID объекта')
				->configureRequired(),
			(new BooleanField(self::F_ACTIVE))
				->configureTitle('Активность')
				->configureDefaultValue(self::ACTIVE_Y)
				->configureValues(self::ACTIVE_N, self::ACTIVE_Y),
			(new DatetimeField(self::F_CREATED_AT))
				->configureTitle('Дата создания')
				->configureDefaultValue(new DateTime()),
			(new DatetimeField(self::F_UPDATED_AT))
				->configureTitle('Дата обновления')
				->configureDefaultValue(new DateTime()),

			(new Reference(
				self::R_APARTMENT,
				ApartmentTable::class,
				Join::on('this.' . self::F_APARTMENT_ID, 'ref.' . ApartmentTable::F_ID)
			))
				->configureJoinType('left'),

			(new Reference(
				self::R_USER,
				CraftUserTable::class,
				Join::on('this.' . self::F_USER_ID, 'ref.' . CraftUserTable::F_ID)
			))
				->configureJoinType('left'),
		];
	}

	public static function getObjectClass()
	{
		return Claim::class;
	}
}