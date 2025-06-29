<?php

namespace Craft\DDD\User\Domain\Entity;

use Craft\DDD\Shared\Domain\ValueObject\EmailValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PasswordValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;

class StudentEntity
{
	public function __construct(
		protected ?int                 $id,
		protected PhoneValueObject     $phone,
		protected EmailValueObject     $email,
		protected ?PasswordValueObject $password,
	)
	{
	}

	public static function register(
		PhoneValueObject     $phone,
		EmailValueObject     $email,
		?PasswordValueObject $password,
	): static
	{
		return new static(
			null,
			$phone,
			$email,
			$password,
		);
	}

	public function refreshIdAfterRegistration(int $id): void
	{
		$this->id = $id;
	}

	public function getEmail(): EmailValueObject
	{
		return $this->email;
	}

	public function getPassword(): ?PasswordValueObject
	{
		return $this->password;
	}

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getPhone(): PhoneValueObject
	{
		return $this->phone;
	}
}