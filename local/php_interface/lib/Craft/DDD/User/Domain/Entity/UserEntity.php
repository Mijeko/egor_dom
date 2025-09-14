<?php

namespace Craft\DDD\User\Domain\Entity;

use Bitrix\Main\Diag\Debug;

class UserEntity
{
	protected int $id;
	protected string $login;
	protected string $phone;
	protected string $email;
	protected ?string $password = null;
	protected ?array $groupIdList = [];
	protected ?array $group = [];


	public static function hydrate(
		int     $id,
		string  $login,
		string  $phone,
		string  $email,
		?string $password = null,
		?array  $groupIdList = [],
	): UserEntity
	{
		$self = new self();
		$self->id = $id;
		$self->login = $login;
		$self->phone = $phone;
		$self->email = $email;
		$self->password = $password;
		$self->groupIdList = $groupIdList;
		return $self;
	}

	public function getEmail(): string
	{
		return $this->email;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getPassword(): string
	{
		return $this->password;
	}

	public function getPhone(): string
	{
		return $this->phone;
	}

	public function getLogin(): string
	{
		return $this->login;
	}


	public function addGroup(GroupEntity $group): UserEntity
	{
		$this->group[] = $group;
		return $this;
	}

	public function getGroup(): array
	{
		return $this->group;
	}

	public function getGroupIdList(): ?array
	{
		return $this->groupIdList;
	}


	public function isAgent(): bool
	{
		return $this->isGroupContain('AGENT');
	}

	public function isManager(): bool
	{
		return $this->isGroupContain('MANAGER');
	}

	public function isAdmin(): bool
	{
		return $this->isGroupContain('ADMIN');
	}

	public function isExtRealtor(): bool
	{
		return $this->isGroupContain('EXT_REALTOR');
	}

	private function isGroupContain(string $code): bool
	{
		$groups = array_filter($this->group, function(GroupEntity $group) use ($code) {
			return $group->getCode() === $code;
		});
		return count($groups) === 1;
	}

}