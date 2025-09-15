<?php

namespace Craft\DDD\User\Application\Service\Interfaces;

use Craft\DDD\User\Domain\Entity\AgentEntity;
use Craft\DDD\User\Domain\Entity\StudentEntity;

interface ManagerAssignerInterface
{
	public function assignManagerToAgent(AgentEntity $agent): void;

	public function assignManagerToStudent(StudentEntity $studentEntity): void;
}