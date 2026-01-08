<?php

namespace Craft\DDD\Referal\Application\UseCase;

use Craft\DDD\Referal\Application\Facade\StorageManager;

class AttachRefCodeToGuestUseCase
{
	const string REF_SESS_STORE_KEY = 'refCode';

	public function __construct(
		private StorageManager $storageManager,
	)
	{
	}

	public function execute(string $referralCode): void
	{
		$this->storageManager->store(
			[self::REF_SESS_STORE_KEY => $referralCode]
		);
	}
}