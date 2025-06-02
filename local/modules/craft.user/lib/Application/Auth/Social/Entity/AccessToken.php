<?php

namespace Craft\User\Application\Auth\Social\Entity;

use Bitrix\Main\Session\SessionInterface;
use Craft\User\Application\Dto\AccessTokenResponseInterface;

abstract class AccessToken implements AccessTokenInterface
{

	protected ?SessionInterface $session = null;

	abstract protected function getSession(): SessionInterface;

	public function store(AccessTokenResponseInterface $value): void
	{
		$tokenData = $value->toArray();
		/* @phpstan-ignore class.notFound */
		$this->session->set($this->getSessionKey(), serialize($tokenData));
	}

	public function isAlive(): bool
	{
		$tokenData = $this->getTokenData();
		if(!$tokenData)
		{
			return false;
		}

		return $tokenData->getExpiresIn() > time();
	}

}