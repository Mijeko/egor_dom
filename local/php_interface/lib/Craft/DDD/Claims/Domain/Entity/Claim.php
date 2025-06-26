<?php

namespace Craft\DDD\Claims\Domain\Entity;

use Craft\DDD\Objects\Domain\Entity\BuildObject;
use Craft\DDD\User\Domain\Entity\User;

class Claim
{

	public function __construct(
		protected ?int         $id,
		protected ?string      $name,
		protected ?BuildObject $buildObject,
		protected ?User        $user,
	)
	{
	}

	public static function createClaim(
		string      $name,
		BuildObject $buildObject,
		User        $user,
	): static
	{
		return new static(
			null,
			$name,
			$buildObject,
			$user
		);
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getBuildObject(): BuildObject
	{
		return $this->buildObject;
	}

	public function getUser(): ?User
	{
		return $this->user;
	}
}