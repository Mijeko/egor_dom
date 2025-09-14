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
	protected ?EmailValueObject $email;
	protected ?PhoneValueObject $phone;
	protected ?string $password;
	protected ?array $additionalEmailList = [];
	protected ?int $avatarId;
	protected ?array $additionalPhones;
	protected ?ImageValueObject $avatar = null;

	public static function hydrate(
		int               $id,
		?string           $name,
		?string           $lastName,
		?string           $secondName,
		?EmailValueObject $email,
		?PhoneValueObject $phone,
		?array            $additionalEmailList,
		?array            $additionalPhones,
		?int              $avatarId,
		?ImageValueObject $avatar = null,

	): ManagerEntity
	{
		$obj = new self();
		$obj->id = $id;
		$obj->name = $name;
		$obj->lastName = $lastName;
		$obj->secondName = $secondName;
		$obj->email = $email;
		$obj->phone = $phone;
		$obj->additionalEmailList = $additionalEmailList;
		$obj->additionalPhones = $additionalPhones;
		$obj->avatarId = $avatarId;
		$obj->avatar = $avatar;
		return $obj;
	}

	public static function createManager(
		EmailValueObject $email,
		PhoneValueObject $phone,
		?string          $password,
		?string          $name,
		?string          $lastName,
	): ManagerEntity
	{
		$self = new self();
		$self->email = $email;
		$self->phone = $phone;
		$self->password = $password;
		$self->name = $name;
		$self->lastName = $lastName;
		return $self;
	}

	public function refreshId(int $id): ManagerEntity
	{
		$this->id = $id;
		return $this;
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
	public function getAdditionalPhones(): ?array
	{
		return $this->additionalPhones;
	}

	public function getAvatar(): ?ImageValueObject
	{
		return $this->avatar;
	}

	public function getAdditionalEmailList(): ?array
	{
		return $this->additionalEmailList;
	}

	public function getAvatarId(): ?int
	{
		return $this->avatarId;
	}

	public function getEmail(): ?EmailValueObject
	{
		return $this->email;
	}

	public function getPhone(): ?PhoneValueObject
	{
		return $this->phone;
	}

	public function getPassword(): ?string
	{
		return $this->password;
	}
}