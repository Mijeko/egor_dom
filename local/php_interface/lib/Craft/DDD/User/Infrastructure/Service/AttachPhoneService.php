<?php

namespace Craft\DDD\User\Infrastructure\Service;

use Bitrix\Main\UserPhoneAuthTable;
use Craft\DDD\User\Application\Contract\ExternalPhoneInterface;

class AttachPhoneService implements ExternalPhoneInterface
{
	public function attach(int $userId, string $phone): bool
	{
		$result = UserPhoneAuthTable::add([
			'USER_ID'      => $userId,
			'PHONE_NUMBER' => UserPhoneAuthTable::normalizePhoneNumber($phone),
		]);

		return $result->isSuccess();
	}

	public function isUse(): bool
	{
		return \COption::GetOptionString('main', 'new_user_phone_auth') == 'Y';
	}

	public function isExists(string $phone): bool
	{
		return UserPhoneAuthTable::getList([
				'filter' => [
					'=PHONE_NUMBER' => UserPhoneAuthTable::normalizePhoneNumber($phone),
				],
			])->getSelectedRowsCount() == 1;
	}
}