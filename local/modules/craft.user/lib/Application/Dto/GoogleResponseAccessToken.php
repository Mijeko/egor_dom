<?php

namespace Craft\User\Application\Dto;

use Craft\Core\Helper\DtoManager;

class GoogleResponseAccessToken extends DtoManager implements AccessTokenResponseInterface
{
	public ?string $accessToken;
	public ?int $expiresIn;
	public ?string $scope;
	public ?string $tokenType;
	public ?string $idToken;

	public function setTokenType($tokenType): void
	{
		$this->tokenType = $tokenType;
	}

	public function setScope($scope): void
	{
		$this->scope = $scope;
	}

	public function setIdToken($idToken): void
	{
		$this->idToken = $idToken;
	}

	public function setExpiresIn($expiresIn): AccessTokenResponseInterface
	{
		$this->expiresIn = time() + $expiresIn;
		return $this;
	}

	public function setAccessToken($accessToken): AccessTokenResponseInterface
	{
		$this->accessToken = $accessToken;
		return $this;
	}

	public function getTokenType()
	{
		return $this->tokenType;
	}

	public function getScope()
	{
		return $this->scope;
	}

	public function getIdToken()
	{
		return $this->idToken;
	}

	public function getAccessToken(): string
	{
		return $this->accessToken;
	}

	public function getExpiresIn(): int
	{
		return $this->expiresIn;
	}
}