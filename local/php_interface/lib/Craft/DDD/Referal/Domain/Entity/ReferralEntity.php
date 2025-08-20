<?php

namespace Craft\DDD\Referal\Domain\Entity;

class ReferralEntity
{
	private int $id;
	private string $code;
	private int $userId;
	private string $link;

	public static function create(
		int    $userId,
		string $code,
	): ReferralEntity
	{
		$self = new self();
		$self->userId = $userId;
		$self->code = $code;
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
		$self->userId = $userId;
		$self->code = $code;
		$self->link = $link;
		return $self;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getUserId(): int
	{
		return $this->userId;
	}

	public function getCode(): string
	{
		return $this->code;
	}

	public function getLink(): string
	{
		return $this->link;
	}
}