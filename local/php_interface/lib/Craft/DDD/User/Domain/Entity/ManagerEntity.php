<?php

namespace Craft\DDD\User\Domain\Entity;

use Craft\DDD\Shared\Domain\ValueObject\EmailValueObject;
use Craft\DDD\Shared\Domain\ValueObject\ImageValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;

class ManagerEntity
{
	public function __construct(
		protected int               $id,
		protected ?string           $name,
		protected ?string           $lastName,
		protected ?string           $secondName,
		protected ?EmailValueObject $email,
		protected ?int              $avatarId,
		protected ?array            $phones,
		protected ?ImageValueObject $avatar = null,
	)
	{
	}

	public function setAvatar(ImageValueObject $avatar): static
	{
		$this->avatar = $avatar;
		return $this;
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

	public function getEmail(): ?EmailValueObject
	{
		return $this->email;
	}

	public function getAvatarId(): ?int
	{
		return $this->avatarId;
	}
}