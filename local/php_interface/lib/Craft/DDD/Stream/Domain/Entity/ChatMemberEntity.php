<?php

namespace Craft\DDD\Stream\Domain\Entity;

use Craft\DDD\Shared\Domain\ValueObject\ImageValueObject;

class ChatMemberEntity
{

	private int $id;
	private int $chatId;
	private int $userId;


	public static function hydrate(
		int $id,
		int $chatId,
		int $userId,
	): ChatMemberEntity
	{
		$self = new self();
		$self->id = $id;
		$self->chatId = $chatId;
		$self->userId = $userId;
		return $self;
	}

	public static function newChatMember(
		int $chatId,
		int $userId,
	): ChatMemberEntity
	{
		$self = new self();
		$self->chatId = $chatId;
		$self->userId = $userId;
		return $self;
	}

	public function refreshId(int $id): ChatMemberEntity
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

	public function getUserId(): int
	{
		return $this->userId;
	}
}