<?php

namespace Craft\DDD\User\Domain\Entity;


use Bitrix\Main\Diag\Debug;

class GroupEntity
{
	protected int $id;
	protected string $name;
	protected string $code;


	public static function hydrate(
		int    $id,
		string $name,
		string $code
	): GroupEntity
	{
		$self = new self();
		$self->id = $id;
		$self->name = $name;
		$self->code = $code;
		return $self;
	}

	public function getCode(): string
	{
		return $this->code;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getName(): string
	{
		return $this->name;
	}


	public function isSkip(): bool
	{
		return mb_strlen($this->code) <= 0 || in_array($this->code, [
				'RATING_VOTE',
				'RATING_VOTE_AUTHORITY',
			]);
	}
}