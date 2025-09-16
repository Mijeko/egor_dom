<?php

namespace Craft\DDD\Claims\Domain\Entity;

use Craft\DDD\Claims\Domain\ValueObject\BuyerManagerIdValueObject;
use Craft\DDD\Shared\Domain\ValueObject\EmailValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;

class BuyerEntity
{
	private int $id;
	private ?BuyerManagerIdValueObject $managerId = null;
	private PhoneValueObject $phone;
	private EmailValueObject $email;


	public static function hydrate(
		int                       $id,
		BuyerManagerIdValueObject $managerId,
		PhoneValueObject          $phone,
		EmailValueObject          $email
	): BuyerEntity
	{
		$self = new self();
		$self->id = $id;
		$self->managerId = $managerId;
		$self->phone = $phone;
		$self->email = $email;
		return $self;
	}

	public function getPhone(): PhoneValueObject
	{
		return $this->phone;
	}

	public function getEmail(): EmailValueObject
	{
		return $this->email;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getManagerId(): ?BuyerManagerIdValueObject
	{
		return $this->managerId;
	}
}