<?php

namespace Craft\DDD\Referal\Application\UseCase;

use Craft\DDD\Referal\Application\Service\StorageInformationInterface;

class MarkGuestUseCase
{

	public function __construct(
		private StorageInformationInterface $storageInformation
	)
	{

	}

	public function execute(string $referralCode): void
	{
		$this->storageInformation->store(['refCode' => $referralCode]);
	}
}