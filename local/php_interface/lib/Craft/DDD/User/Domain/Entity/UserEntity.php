<?php

namespace Craft\DDD\User\Domain\Entity;

use Craft\Model\CraftUser;

class UserEntity
{
	public function __construct(
		protected string  $id,
		protected string  $login,
		protected string  $phone,
		protected string  $email,
		protected ?string $password = null,
	)
	{
	}

	public static function hydrate(CraftUser $user): static
	{
		return new static(
			$user->getId(),
			$user->getLogin(),
			$user->getPersonalPhone(),
			$user->getEmail(),
			null,
		);
	}

	public function validatePassword(string $password): bool
	{
		return password_verify($password, $this->password);
	}


	public function getEmail(): string
	{
		return $this->email;
	}

	public function getId(): string
	{
		return $this->id;
	}

	public function getPassword(): string
	{
		return $this->password;
	}

	public function getPhone(): string
	{
		return $this->phone;
	}

	public function getLogin(): string
	{
		return $this->login;
	}

}