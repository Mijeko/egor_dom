<?php

namespace Craft\DDD\Stream\Domain\Entity;

class ChatEntity
{
	private int $id;
	private array $messages;


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

}