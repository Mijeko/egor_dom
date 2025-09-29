<?php

namespace Craft\DDD\Stream\Domain\Entity;

class MessageEntity
{

	private int $chatId;
	private int $id;
	private string $message;

	public static function createMessage(
		ChatEntity $chat,
		string     $message
	): MessageEntity
	{
		$self = new self();
		$self->chatId = $chat->getId();
		$self->message = $message;
		return $self;
	}

	public static function hydrate(
		int    $id,
		int    $chatId,
		string $message
	): MessageEntity
	{
		$self = new self();
		$self->id = $id;
		$self->chatId = $chatId;
		$self->message = $message;
		return $self;
	}

	public function refreshId(
		int $id,
	): MessageEntity
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

}