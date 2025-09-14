<?php

namespace Craft\DDD\User\Infrastructure\Service;

use Craft\DDD\User\Application\Service\Interfaces\PasswordGeneratorInterface;

class PasswordGenerator implements PasswordGeneratorInterface
{
	public function generate(int $length = 16): string
	{
		return \Bitrix\Main\Authentication\ApplicationPasswordTable::generatePassword();
	}
}