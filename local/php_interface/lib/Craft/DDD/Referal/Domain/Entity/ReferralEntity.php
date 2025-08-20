<?php

namespace Craft\DDD\Referal\Domain\Entity;

class ReferralEntity
{
	private int $id;
	private int $userId;
	private int $inviteUserId;
	private string $code;
	private string $phone;
	private string $link;

	public static function create(
		string $phone,
		string $code,
	): ReferralEntity
	{
		$self = new self();
		$self->phone = $phone;
		$self->code = $code;
		$self->link = sprintf('https://abn.ru/ref/%s/', $code);
		return $self;
	}

	public static function invite(
		int    $inviteUserId,
		string $phone,
		string $code,
	): ReferralEntity
	{
		$self = new self();
		$self->phone = $phone;
		$self->code = $code;
		$self->inviteUserId = $inviteUserId;
		$self->link = sprintf('https://abn.ru/ref/%s/', $code);
		return $self;
	}

	public static function hydrate(
		int    $id,
		int    $userId,
		string $code,
		string $link
	): ReferralEntity
	{
		$self = new self();
		$self->id = $id;
		$self->phone = $userId;
		$self->code = $code;
		$self->link = $link;
		return $self;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getPhone(): string
	{
		return $this->phone;
	}

	public function getCode(): string
	{
		return $this->code;
	}

	public function getLink(): string
	{
		return $this->link;
	}

	public function getUserId(): int
	{
		return $this->userId;
	}

	public function getInviteUserId(): int
	{
		return $this->inviteUserId;
	}
}