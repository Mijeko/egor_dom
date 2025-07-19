<?php

namespace Craft\DDD\City\Infrastructure\Service\CurrentCityStorage;

use Bitrix\Main\Diag\Debug;
use Bitrix\Main\Session\SessionInterface;
use Craft\DDD\City\Domain\Entity\CityEntity;
use Craft\DDD\City\Infrastructure\Interfaces\City\CurrentCityStorageInterface;
use Bitrix\Main\Application;

class SessionCurrentCityStorage implements CurrentCityStorageInterface
{
	const SESSION_KEY = 'currentCity';

	protected ?SessionInterface $session = null;

	public function __construct()
	{
		$this->session = Application::getInstance()->getSession();
	}

	public function store(CityEntity $cityEntity): void
	{
		$this->session->set(static::SESSION_KEY, json_encode(['id' => $cityEntity->getId(), 'name' => $cityEntity->getName()]));
	}

	public function get(): int
	{
		$rawJson = $this->session->get(static::SESSION_KEY);
		if(!json_validate($rawJson))
		{
			throw new \Exception('Некорректное значение города в сессии');
		}


		$data = json_decode($rawJson, true);

		if(!array_key_exists('id', $data))
		{
			throw new \Exception('Город не установлен в сессиях');
		}

		return intval($data['id']);
	}

	public function clean(): void
	{
		$this->session->remove(static::SESSION_KEY);
	}

	public function has(): bool
	{
		return $this->session->has(static::SESSION_KEY);
	}
}