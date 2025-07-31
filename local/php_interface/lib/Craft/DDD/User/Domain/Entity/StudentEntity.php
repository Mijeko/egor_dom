<?php

namespace Craft\DDD\User\Domain\Entity;

use Craft\DDD\Shared\Domain\ValueObject\ActiveValueObject;
use Craft\DDD\Shared\Domain\ValueObject\EmailValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PasswordValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;

final class StudentEntity
{
	protected ?int $id;
	protected PhoneValueObject $phone;
	protected EmailValueObject $email;
	protected ?PasswordValueObject $password;
	protected ActiveValueObject $active;


	public static function register(
		PhoneValueObject     $phone,
		EmailValueObject     $email,
		?PasswordValueObject $password,
	): StudentEntity
	{
		$obj = new self();
		$obj->phone = $phone;
		$obj->email = $email;
		$obj->password = $password;
		$obj->active = ActiveValueObject::notActive();
		return $obj;
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

	public function getActive(): ActiveValueObject
	{
		return $this->active;
	}
}