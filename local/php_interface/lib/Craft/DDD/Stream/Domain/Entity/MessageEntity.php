<?php

namespace Craft\DDD\Stream\Domain\Entity;

class MessageEntity
{

	private int $chatId;
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

	public function getChatId(): int
	{
		return $this->chatId;
	}

	public function getMessage(): string
	{
		return $this->message;
	}

}