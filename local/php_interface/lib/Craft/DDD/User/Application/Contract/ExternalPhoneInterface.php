<?php

namespace Craft\DDD\User\Application\Contract;

interface ExternalPhoneInterface
{
	public function isUse(): bool;

	public function isExists(string $phone): bool;

	public function attach(int $userId, string $phone): bool;
}