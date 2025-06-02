<?php

namespace Craft\User\Domain\Interfaces;

use Craft\User\Application\Entity\JUser;
use Craft\User\Domain\Dto\UserRegisterDto;

interface UserRegisterInterface
{
	public function register(string $email, string $phone, string $password, ?UserRegisterDto $additionalParams = null): ?JUser;
}