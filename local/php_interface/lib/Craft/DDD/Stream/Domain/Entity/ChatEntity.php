<?php

namespace Craft\DDD\Stream\Domain\Entity;

use Craft\DDD\Shared\Domain\ValueObject\ActiveValueObject;

class ChatEntity
{
	private int $id;
	private ActiveValueObject $active;


	public static function createNewChat(): ChatEntity
	{
		$self = new self();
		$self->active = ActiveValueObject::active();
		return $self;
	}

	public function refreshId(int $id): ChatEntity
	{
		$this->id = $id;
		return $this;
	}

	public static function hydrate(
		int               $id,
		ActiveValueObject $active,
	): ChatEntity
	{
		$self = new self();
		$self->id = $id;
		$self->active = $active;
		return $self;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getActive(): ActiveValueObject
	{
		return $this->active;
	}
}