<?php

namespace Craft\DDD\Claims\Domain\Entity;

use Craft\DDD\Shared\Domain\ValueObject\AvailChannelContactValueObject;

class ManagerEntity
{
	protected ?int $id = null;
	protected ?string $name = null;
	protected ?AvailChannelContactValueObject $availChannelContact;


	public static function hydrate(
		int                             $id,
		string                          $name,
		?AvailChannelContactValueObject $availChannelContact = null,
	): ManagerEntity
	{
		$self = new self();
		$self->id = $id;
		$self->name = $name;
		$self->availChannelContact = $availChannelContact;
		return $self;
	}

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function getAvailChannelContact(): ?AvailChannelContactValueObject
	{
		return $this->availChannelContact;
	}
}