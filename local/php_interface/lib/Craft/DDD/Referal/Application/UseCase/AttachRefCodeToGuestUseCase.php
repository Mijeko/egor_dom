<?php

namespace Craft\DDD\Referal\Application\UseCase;

use Craft\DDD\Referal\Application\Facade\StorageManager;

class AttachRefCodeToGuestUseCase
{

	public function __construct(
		private StorageManager $storageManager,
	)
	{
	}

	public function execute(string $referralCode): void
	{
		$this->storageManager->storeCode(
			$referralCode
		);
	}
}