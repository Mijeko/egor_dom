<?php

namespace Craft\User\Application\Dto;

interface AccessTokenResponseInterface
{
	public function getAccessToken(): string;

	public function setAccessToken(string $accessToken): AccessTokenResponseInterface;

	public function getExpiresIn(): int;

	public function setExpiresIn(int $expiresIn): AccessTokenResponseInterface;
}