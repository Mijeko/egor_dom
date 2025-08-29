<?php

namespace Craft\DDD\Referal\Application\UseCase;

use Craft\DDD\Referal\Application\Service\StorageInformationInterface;

class MarkGuestUseCase
{
	const string REF_SESS_STORE_KEY = 'refCode';

	public function __construct(
		private StorageInformationInterface $storageInformation
	)
	{

	}

	public function storeRefCode(string $referralCode): void
	{
		$this->storageInformation->store([self::REF_SESS_STORE_KEY => $referralCode]);
	}

	public function getRefCode(): ?string
	{
		$_rawData = $this->storageInformation->getData();

		if(array_key_exists(self::REF_SESS_STORE_KEY, $_rawData))
		{
			return $_rawData[self::REF_SESS_STORE_KEY];
		}

		return null;
	}
}