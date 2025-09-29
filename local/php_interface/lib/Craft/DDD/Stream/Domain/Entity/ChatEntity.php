<?php

namespace Craft\DDD\Stream\Domain\Entity;

use Craft\DDD\Shared\Domain\ValueObject\ActiveValueObject;

class ChatEntity
{
	private int $id;
	private ActiveValueObject $active;
	private int $userId;
	private int $acceptUserId;
	private array $messages;

	public static function createNewChat(
		int $userId,
		int $acceptUserId,
	): ChatEntity
	{
		$self = new self();
		$self->userId = $userId;
		$self->acceptUserId = $acceptUserId;
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
		int               $userId,
		int               $acceptUserId,
	): ChatEntity
	{
		$self = new self();
		$self->id = $id;
		$self->userId = $userId;
		$self->acceptUserId = $acceptUserId;
		$self->active = $active;
		return $self;
	}

	public function addMessage(MessageEntity $message): ChatEntity
	{
		$this->messages[] = $message;
		return $this;
	}


	public function getId(): int
	{
		return $this->id;
	}

	public function getMessages(): array
	{
		return $this->messages;
	}

	public function getActive(): ActiveValueObject
	{
		return $this->active;
	}

	public function getUserId(): int
	{
		return $this->userId;
	}

	public function getAcceptUserId(): int
	{
		return $this->acceptUserId;
	}

	public function setMessages(array $messages): void
	{
		$this->messages = $messages;
	}

}