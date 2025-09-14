<?php

namespace Craft\DDD\User\Domain\Entity;


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

	public function isAdmin(): bool
	{
		return $this->code === 'ADMIN';
	}

	public function isManager(): bool
	{
		return $this->code === 'MANAGER';
	}

	public function isAgent(): bool
	{
		return $this->code === 'AGENT';
	}
}