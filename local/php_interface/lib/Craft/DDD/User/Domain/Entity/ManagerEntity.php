<?php

namespace Craft\DDD\User\Domain\Entity;

use Craft\DDD\Shared\Domain\ValueObject\EmailValueObject;
use Craft\DDD\Shared\Domain\ValueObject\ImageValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;

class ManagerEntity
{


	protected int $id;
	protected ?string $name;
	protected ?string $lastName;
	protected ?string $secondName;
	protected ?array $email;
	protected ?int $avatarId;
	protected ?array $phones;
	protected ?ImageValueObject $avatar = null;

	public static function fromFind(
		int               $id,
		?string           $name,
		?string           $lastName,
		?string           $secondName,
		?array            $email,
		?int              $avatarId,
		?array            $phones,
		?ImageValueObject $avatar = null,

	): ManagerEntity
	{
		$obj = new self();
		$obj->id = $id;
		$obj->name = $name;
		$obj->lastName = $lastName;
		$obj->secondName = $secondName;
		$obj->email = $email;
		$obj->avatarId = $avatarId;
		$obj->phones = $phones;
		$obj->avatar = $avatar;
		return $obj;
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

	public function getEmail(): ?array
	{
		return $this->email;
	}

	public function getAvatarId(): ?int
	{
		return $this->avatarId;
	}
}