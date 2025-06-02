<?php

namespace Craft\User\Application\Dto;

use Craft\Core\Helper\DtoManager;

final class GoogleUserInfo extends DtoManager implements UserInfoInterface
{

	public ?string $id = null;
	public ?string $email = null;
	public ?bool $verifiedEmail = null;
	public ?string $name = null;
	public ?string $givenName = null;
	public ?string $familyName = null;
	public ?string $picture = null;

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function getFamilyName(): ?string
	{
		return $this->familyName;
	}

	public function getGivenName(): ?string
	{
		return $this->givenName;
	}

	public function getPicture(): ?string
	{
		return $this->picture;
	}

	public function getVerifiedEmail(): ?bool
	{
		return $this->verifiedEmail;
	}

	public function getEmail(): ?string
	{
		return $this->email;
	}

	public function setEmail(?string $email): void
	{
		$this->email = $email;
	}

	public function setId(?string $id): void
	{
		$this->id = $id;
	}

	public function setFamilyName(?string $familyName): void
	{
		$this->familyName = $familyName;
	}

	public function setGivenName(?string $givenName): void
	{
		$this->givenName = $givenName;
	}

	public function setName(?string $name): void
	{
		$this->name = $name;
	}

	public function setPicture(?string $picture): void
	{
		$this->picture = $picture;
	}

	public function setVerifiedEmail(?bool $verifiedEmail): void
	{
		$this->verifiedEmail = $verifiedEmail;
	}
}