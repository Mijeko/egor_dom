<?php

namespace Craft\DDD\City\Infrastructure\Service;

use Bitrix\Main\Context;
use Bitrix\Main\Web\Cookie;
use Bitrix\Main\Application;
use Bitrix\Main\Session\SessionInterface;
use Craft\DDD\City\Domain\Entity\CityEntity;
use Craft\DDD\City\Infrastructure\Interfaces\City\CurrentCityStorageInterface;

class CookieCurrentCityStorage implements CurrentCityStorageInterface
{

	const SESSION_KEY = 'currentCity';

	protected SessionInterface $session;

	public function __construct()
	{
		session_start();
		$this->session = Application::getInstance()->getSession();
	}

	public function store(CityEntity $cityEntity): void
	{
		$cookie = new Cookie(self::SESSION_KEY, json_encode(['id' => $cityEntity->getId(), 'name' => $cityEntity->getName()]), time() + 60 * 60 * 24 * 30 * 12 * 2);
		$cookie->setHttpOnly(false);
		$this->storeCookie($cookie);
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
		$cookie = new Cookie(self::SESSION_KEY, null, time() - 3600);
		$this->storeCookie($cookie);
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

	private function storeCookie(Cookie $cookie): void
	{
		Context::getCurrent()
			->getResponse()
			->addCookie($cookie);
	}
}