<?php

namespace Craft\DDD\User\Domain\Entity;


use Craft\DDD\Shared\Domain\ValueObject\EmailValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;

/**
 * Внешний риэлтор
 */
class ExternalRealtorEntity
{
	private int $id;

	private string $name;
	private string $lastName;
	private string $secondName;
	private EmailValueObject $email;
	private PhoneValueObject $phone;

	private ?int $avatarId;
	private ?int $percentAward = 0;

	public static function hydrate(
		int              $id,
		string           $name,
		string           $lastName,
		string           $secondName,
		EmailValueObject $email,
		PhoneValueObject $phone,
		int              $avatarId
	): ExternalRealtorEntity
	{
		$self = new self();
		$self->id = $id;
		$self->name = $name;
		$self->lastName = $lastName;
		$self->secondName = $secondName;
		$self->email = $email;
		$self->phone = $phone;
		$self->avatarId = $avatarId;
		return $self;
	}

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * @return EmailValueObject
	 */
	public function getEmail(): EmailValueObject
	{
		return $this->email;
	}

	/**
	 * @return PhoneValueObject
	 */
	public function getPhone(): PhoneValueObject
	{
		return $this->phone;
	}

	/**
	 * @return string
	 */
	public function getLastName(): string
	{
		return $this->lastName;
	}

	/**
	 * @return string
	 */
	public function getSecondName(): string
	{
		return $this->secondName;
	}

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}

	public function getAvatarId(): ?int
	{
		return $this->avatarId;
	}

	public function getPercentAward(): ?int
	{
		return $this->percentAward;
	}
}