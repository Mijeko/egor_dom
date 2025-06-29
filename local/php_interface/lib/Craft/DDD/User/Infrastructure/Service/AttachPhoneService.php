<?php

namespace Craft\DDD\User\Infrastructure\Service;

use Bitrix\Main\UserPhoneAuthTable;

class AttachPhoneService
{
	public function isExist(string $phone): bool
	{
		return UserPhoneAuthTable::getList([
				'filter' => [
					'=PHONE_NUMBER' => UserPhoneAuthTable::normalizePhoneNumber($phone),
				],
			])->getSelectedRowsCount() == 1;
	}

	public function attach(int $userId, string $phone): void
	{
		$result = UserPhoneAuthTable::add([
			'USER_ID'      => $userId,
			'PHONE_NUMBER' => UserPhoneAuthTable::normalizePhoneNumber($phone),
		]);
	}
}