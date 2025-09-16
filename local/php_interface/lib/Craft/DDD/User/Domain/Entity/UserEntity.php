<?php

namespace Craft\DDD\User\Domain\Entity;

use Craft\DDD\Shared\Domain\ValueObject\EmailValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PasswordValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;

class UserEntity
{
	protected int $id;
	protected string $login;
	protected PhoneValueObject $phone;
	protected EmailValueObject $email;
	protected ?PasswordValueObject $password = null;
	protected ?string $name;
	protected ?string $lastName;
	protected ?string $secondName;
	protected ?int $avatarId = null;
	protected ?array $groupIdList = [];
	protected ?array $group = [];


	public static function hydrate(
		int                  $id,
		string               $login,
		?string              $name,
		?string              $lastName,
		?string              $secondName,
		?int                 $avatarId,
		PhoneValueObject     $phone,
		EmailValueObject     $email,
		?PasswordValueObject $password = null,
		?array               $groupIdList = [],
	): UserEntity
	{
		$self = new self();
		$self->id = $id;
		$self->login = $login;
		$self->name = $name;
		$self->lastName = $lastName;
		$self->secondName = $secondName;
		$self->avatarId = $avatarId;
		$self->phone = $phone;
		$self->email = $email;
		$self->password = $password;
		$self->groupIdList = $groupIdList;
		return $self;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function getSecondName(): ?string
	{
		return $this->secondName;
	}

	public function getLastName(): ?string
	{
		return $this->lastName;
	}

	public function getEmail(): EmailValueObject
	{
		return $this->email;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getPassword(): PasswordValueObject
	{
		return $this->password;
	}

	public function getPhone(): PhoneValueObject
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

	public function getAvatarId(): ?int
	{
		return $this->avatarId;
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