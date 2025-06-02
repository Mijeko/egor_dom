<?php

namespace Craft\User\Application\Auth\Social\Entity;

use Bitrix\Main\Application;
use Bitrix\Main\Session\SessionInterface;
use Craft\User\Application\Dto\VkResponseAccessTokenDto;

class VkAccessToken extends AccessToken
{
	protected static ?VkAccessToken $instance = null;

	public static function instance(): VkAccessToken
	{
		if(is_null(self::$instance))
		{
			self::$instance = new static();
		}

		return self::$instance;
	}

	public function __construct()
	{
		$this->session = Application::getInstance()->getSession();
	}

	protected function getSession(): SessionInterface
	{
		return $this->session;
	}

	public function getSessionKey(): string
	{
		return 'vk_access_token_store';
	}

	public function getTokenData(): ?VkResponseAccessTokenDto
	{
		/* @phpstan-ignore class.notFound */
		$value = unserialize($this->session->get($this->getSessionKey()));

		if(!is_array($value))
		{
			return null;
		}

		return VkResponseAccessTokenDto::fromArray($value);
	}
}