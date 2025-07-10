<?php

namespace Craft\Model;

use Bitrix\Main\ORM\Fields\Relations\OneToMany;
use Bitrix\Main\UserTable;
use Craft\DDD\Claims\Infrastructure\Entity\ClaimTable;

class CraftUserTable extends UserTable
{

	const F_ID = 'ID';
	const F_LOGIN = 'LOGIN';
	const F_EMAIL = 'EMAIL';
	const F_PASSWORD = 'PASSWORD';

	const F_NAME = 'NAME';
	const F_LAST_NAME = 'LAST_NAME';
	const F_SECOND_NAME = 'SECOND_NAME';
	const F_PERSONAL_PHONE = 'PERSONAL_PHONE';


	const F_UF_INN = 'UF_INN';
	const F_UF_KPP = 'UF_KPP';
	const F_UF_BIK = 'UF_BIK';
	const F_UF_OGRN = 'UF_OGRN';
	const UF_BANK_NAME = 'UF_BANK_NAME';
	const F_UF_LEGAL_ADDRESS = 'UF_LEGAL_ADDRESS';
	const F_UF_POST_ADDRESS = 'UF_POST_ADDRESS';
	const F_UF_CURR_ACC = 'UF_CURR_ACC';
	const F_UF_CORR_ACC = 'UF_CORR_ACC';
	const F_UF_BANK_NAME = 'UF_BANK_NAME';

	const R_ORDERS = 'ORDERS';

	public static function getMap()
	{
		$map = parent::getMap();
		return array_merge($map, [


			(new OneToMany(
				self::R_ORDERS,
				ClaimTable::class,
				ClaimTable::R_USER
			))
				->configureJoinType('left'),
		]);
	}

	public static function getObjectClass()
	{
		return CraftUser::class;
	}
}