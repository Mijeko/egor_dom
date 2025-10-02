<?php

namespace Craft\DDD\Stream\Domain\Entity;

class ChatMessageEntity
{

	private int $chatId;
	private int $id;
	private int $userId;
	private string $message;

	public static function createMessage(
		ChatEntity $chat,
		int        $userId,
		string     $message
	): ChatMessageEntity
	{
		$self = new self();
		$self->chatId = $chat->getId();
		$self->message = $message;
		$self->userId = $userId;
		return $self;
	}

	public static function hydrate(
		int    $id,
		int    $chatId,
		int    $userId,
		string $message
	): ChatMessageEntity
	{
		$self = new self();
		$self->id = $id;
		$self->chatId = $chatId;
		$self->userId = $userId;
		$self->message = $message;
		return $self;
	}

	public function refreshId(
		int $id,
	): ChatMessageEntity
	{
		$this->id = $id;
		return $this;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getChatId(): int
	{
		return $this->chatId;
	}

	public function getMessage(): string
	{
		return $this->message;
	}

	public function getUserId(): int
	{
		return $this->userId;
	}
}