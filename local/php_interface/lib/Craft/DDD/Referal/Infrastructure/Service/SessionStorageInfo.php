<?php

namespace Craft\DDD\Referal\Infrastructure\Service;

use Bitrix\Main\Application;
use Bitrix\Main\Session\SessionInterface;
use Craft\DDD\Referal\Application\Contract\StorageInformationInterface;

class SessionStorageInfo implements StorageInformationInterface
{
	const string REF_SESS_STORE_KEY = 'refCode';

	private SessionInterface $session;

	public function __construct()
	{
		$this->session = Application::getInstance()->getSession();
	}


	public function store(array $data): void
	{
		$this->session->set(self::REF_SESS_STORE_KEY, json_encode($data));
	}

	public function getData(): array
	{
		$_rawData = $this->session->get(self::REF_SESS_STORE_KEY);

		if(json_validate($_rawData))
		{
			return json_decode($_rawData, true);
		}

		return [];
	}
}