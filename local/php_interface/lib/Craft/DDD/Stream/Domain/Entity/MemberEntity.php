<?php

namespace Craft\DDD\Stream\Domain\Entity;

use Craft\DDD\Shared\Domain\ValueObject\ImageValueObject;

class MemberEntity
{

	private int $id;
	private string $username;
	private int $avatarId;

	private ?ImageValueObject $avatar = null;

	public static function hydrate(
		int    $id,
		string $name,
		int    $avatarId,
	): MemberEntity
	{
		$self = new self();
		$self->id = $id;
		$self->username = $name;
		$self->avatarId = $avatarId;
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
}