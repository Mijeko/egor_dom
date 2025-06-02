<?php

namespace Craft\User\Application\Auth\Social;


use Craft\User\Application\Dto\AccessTokenResponseInterface;
use Craft\User\Application\Dto\UserInfoInterface;

interface SocialAuthServiceInterface
{
	public function getRegisterLink(): string;

	public function label(): string;

	public function getDefaultParamsAuth(): array;

	public function getAccessToken(string $code): AccessTokenResponseInterface;

	public function userInfo(string $accessToken): ?UserInfoInterface;

}