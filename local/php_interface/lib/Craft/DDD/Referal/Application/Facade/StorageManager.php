<?php

namespace Craft\DDD\Referal\Application\Facade;

use Craft\DDD\Referal\Application\Contract\StorageInformationInterface;
use Craft\DDD\Referal\Infrastructure\Service\SessionStorageInfo;

class StorageManager
{
	const string REF_SESS_STORE_KEY = 'refCode';

	private StorageInformationInterface $storageInformation;

	public static function instance(): StorageManager
	{
		return new static();
	}

	public function __construct()
	{
		$this->storageInformation = new SessionStorageInfo();
	}


	public function store(array $data): void
	{
		$this->storageInformation->store($data);
	}

	public function getCode(): ?string
	{
		$_rawData = $this->storageInformation->getData();

		if(array_key_exists(self::REF_SESS_STORE_KEY, $_rawData))
		{
			return $_rawData[self::REF_SESS_STORE_KEY];
		}

		return null;

	}
}