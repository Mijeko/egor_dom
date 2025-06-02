<?php

namespace Craft\User\Application\Auth\Social\Entity;

use Bitrix\Main\Session\Session;
use Bitrix\Main\Session\SessionInterface;
use Craft\User\Application\Dto\GoogleResponseAccessToken;

class GoogleAccessToken extends AccessToken
{

	protected ?SessionInterface $session = null;
	protected static ?GoogleAccessToken $instance = null;

	public function __construct()
	{
		$this->session = new Session();
	}

	protected function getSession(): SessionInterface
	{
		return $this->session;
	}

	public static function instance(): GoogleAccessToken
	{
		if(is_null(self::$instance))
		{
			self::$instance = new static();
		}

		return self::$instance;
	}

	public function getSessionKey(): string
	{
		return 'google_access_token_store';
	}


	public function getTokenData(): ?GoogleResponseAccessToken
	{
		/* @phpstan-ignore class.notFound */
		$value = unserialize($this->session->get($this->getSessionKey()));

		if(!is_array($value))
		{
			return null;
		}

		return GoogleResponseAccessToken::fromArray($value);
	}
}