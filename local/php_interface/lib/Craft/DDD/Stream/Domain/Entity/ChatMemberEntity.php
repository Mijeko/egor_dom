<?php

namespace Craft\DDD\Stream\Domain\Entity;

use Craft\DDD\Shared\Domain\ValueObject\ImageValueObject;

class ChatMemberEntity
{

	private int $id;
	private string $username;
	private int $avatarId;
	private int $chatId;

	private ?ImageValueObject $avatar = null;

	public static function hydrate(
		int    $id,
		string $name,
		int    $avatarId,
		int    $chatId,
	): ChatMemberEntity
	{
		$self = new self();
		$self->id = $id;
		$self->username = $name;
		$self->avatarId = $avatarId;
		$self->chatId = $chatId;
		return $self;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getUsername(): string
	{
		return $this->username;
	}

	public function getAvatarId(): int
	{
		return $this->avatarId;
	}

	public function getAvatar(): ?ImageValueObject
	{
		return $this->avatar;
	}

	public function getChatId(): int
	{
		return $this->chatId;
	}
}