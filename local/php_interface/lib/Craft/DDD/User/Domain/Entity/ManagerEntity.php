<?php

namespace Craft\DDD\User\Domain\Entity;

use Craft\DDD\Shared\Domain\ValueObject\ImageValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;

class ManagerEntity
{
	public function __construct(
		protected int               $id,
		protected ?string           $name,
		protected ?string           $lastName,
		protected ?string           $secondName,
		protected ?array            $phones,
		protected ?ImageValueObject $avatar,
	)
	{
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function addPhone(PhoneValueObject $phone): void
	{
		$this->phones[] = $phone;
	}

	public function getSecondName(): ?string
	{
		return $this->secondName;
	}

	public function getLastName(): ?string
	{
		return $this->lastName;
	}

	/**
	 * @return PhoneValueObject[]|null
	 */
	public function getPhones(): ?array
	{
		return $this->phones;
	}

	public function getAvatar(): ?ImageValueObject
	{
		return $this->avatar;
	}
}