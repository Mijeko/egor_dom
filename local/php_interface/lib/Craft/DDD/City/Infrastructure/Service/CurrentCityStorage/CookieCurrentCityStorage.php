<?php

namespace Craft\DDD\City\Infrastructure\Service\CurrentCityStorage;

use Bitrix\Main\Context;
use Bitrix\Main\Diag\Debug;
use Bitrix\Main\Web\Cookie;
use Bitrix\Main\Application;
use Bitrix\Main\Session\SessionInterface;
use Craft\DDD\City\Domain\Entity\CityEntity;
use Craft\DDD\City\Infrastructure\Interfaces\City\CurrentCityStorageInterface;

class CookieCurrentCityStorage implements CurrentCityStorageInterface
{

	const SESSION_KEY = 'currentCity';

	public function store(CityEntity $cityEntity): void
	{
		$this->buildCookie(
			['id' => $cityEntity->getId(), 'name' => $cityEntity->getName()],
			time() + 60 * 60 * 24 * 30 * 12 * 2
		);
	}

	public function get(): int
	{
		$currentSession = $this->getJson();
		if(array_key_exists('id', $currentSession))
		{
			return intval($currentSession['id']);
		}

		return 0;
	}

	public function clean(): void
	{
		$this->buildCookie(
			[null => rand()],
			time() - 3600
		);
	}

	public function has(): bool
	{
		$data = $this->getJson();
		return array_key_exists('id', $data);
	}

	private function getJson(): array
	{
		$rawJsonData = Context::getCurrent()->getRequest()->getCookie(self::SESSION_KEY);
		if(!json_validate($rawJsonData))
		{
			return [];
		}

		return json_decode($rawJsonData, true);
	}

	private function buildCookie(array $data, $time): void
	{

		$cookie = new Cookie(self::SESSION_KEY, json_encode($data), $time);
		$cookie->setHttpOnly(false)
			->setSecure(false);

		$this->storeCookie($cookie);
	}

	private function storeCookie(Cookie $cookie): void
	{
		Context::getCurrent()
			->getResponse()
			->addCookie($cookie);
	}
}