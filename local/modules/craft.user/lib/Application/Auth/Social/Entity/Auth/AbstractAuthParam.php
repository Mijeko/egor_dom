<?php

namespace Craft\User\Application\Auth\Social\Entity\Auth;

use Bitrix\Main\Application;
use Bitrix\Main\Session\SessionInterface;

abstract class AbstractAuthParam implements AuthParam
{
	protected ?string $value = null;
	protected SessionInterface $session;

	abstract function getSessionKey(): string;

	public function __construct()
	{
		$this->session = Application::getInstance()->getSession();
	}

	public function getValue(): string
	{
		return $this->value;
	}

	public function storeInSession(): void
	{
		/* @phpstan-ignore class.notFound */
		$this->session->set($this->getSessionKey(), $this->value);
	}

	public function sessionValue(): ?string
	{
		/* @phpstan-ignore class.notFound */
		return $this->session->get($this->getSessionKey());
	}
}