<?php

namespace Craft\DDD\User\Domain\Repository;

use Craft\DDD\Shared\Domain\ValueObject\InnValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;
use Craft\DDD\User\Domain\Entity\AgentEntity;

interface AgentRepositoryInterface
{
	public function create(AgentEntity $agent): ?AgentEntity;

	public function update(AgentEntity $agent): ?AgentEntity;

	public function findById(int $id): ?AgentEntity;

	public function findByInn(InnValueObject $inn): ?AgentEntity;

	public function findByPhone(PhoneValueObject $phone): ?AgentEntity;
}