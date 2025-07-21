<?php

namespace Craft\DDD\Claims\Domain\Entity;

use Craft\DDD\Shared\Domain\ValueObject\AvailChannelContactValueObject;

class ManagerEntity
{
	public function __construct(
		protected ?int                            $id = null,
		protected ?string                         $name = null,
		protected ?AvailChannelContactValueObject $availChannelContact
	)
	{
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