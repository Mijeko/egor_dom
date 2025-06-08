<?php

namespace Craft\User\Application\Auth\Social;

use Craft\User\Application\Dto\AccessTokenResponseInterface;
use Craft\User\Application\Dto\UserInfoInterface;

final class MailRuService implements SocialAuthServiceInterface
{
	public function getRegisterLink(): string
	{
		return '';
	}

	public function label(): string
	{
		return 'MailRu';
	}

	public function getDefaultParamsAuth(): array
	{
		// TODO: Implement getDefaultParamsAuth() method.
	}

	public function getAccessToken(string $code): AccessTokenResponseInterface
	{
		// TODO: Implement getAccessToken() method.
	}

	public function userInfo(string $accessToken): ?UserInfoInterface
	{
		// TODO: Implement userInfo() method.
	}
}