<?php

namespace Craft\User\Application\Dto;

use Craft\Core\Helper\DtoManager;

final class VkResponseAccessTokenDto extends DtoManager implements AccessTokenResponseInterface
{
	public string $refreshToken;
	public string $accessToken;
	public string $idToken;
	public string $tokenType;
	public int $expiresIn;
	public int $userId;
	public string $state;
	public string $scope;


	public function setAccessToken(string $accessToken): AccessTokenResponseInterface
	{
		$this->accessToken = $accessToken;
		return $this;
	}

	public function setExpiresIn(int $expiresIn): AccessTokenResponseInterface
	{
		$this->expiresIn = time() + $expiresIn;
		return $this;
	}

	public function setIdToken(string $idToken): VkResponseAccessTokenDto
	{
		$this->idToken = $idToken;
		return $this;
	}

	public function setRefreshToken(string $refreshToken): VkResponseAccessTokenDto
	{
		$this->refreshToken = $refreshToken;
		return $this;
	}

	public function setScope(string $scope): VkResponseAccessTokenDto
	{
		$this->scope = $scope;
		return $this;
	}

	public function setState(string $state): VkResponseAccessTokenDto
	{
		$this->state = $state;
		return $this;
	}

	public function setTokenType(string $tokenType): VkResponseAccessTokenDto
	{
		$this->tokenType = $tokenType;
		return $this;
	}

	public function setUserId(int $userId): VkResponseAccessTokenDto
	{
		$this->userId = $userId;
		return $this;
	}

	public function getIdToken(): string
	{
		return $this->idToken;
	}

	public function getScope(): string
	{
		return $this->scope;
	}

	public function getState(): string
	{
		return $this->state;
	}

	public function getTokenType(): string
	{
		return $this->tokenType;
	}


	public function getRefreshToken(): string
	{
		return $this->refreshToken;
	}

	public function getExpiresIn(): int
	{
		return $this->expiresIn;
	}

	public function getAccessToken(): string
	{
		return $this->accessToken;
	}

	public function getUserId(): int
	{
		return $this->userId;
	}
}