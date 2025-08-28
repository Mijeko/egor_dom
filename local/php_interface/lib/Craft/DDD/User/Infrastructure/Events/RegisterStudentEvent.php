<?php

namespace Craft\DDD\User\Infrastructure\Events;

use Craft\DDD\User\Domain\Entity\StudentEntity;
use Symfony\Contracts\EventDispatcher\Event;

class RegisterStudentEvent extends Event
{

	const string EVENT_NAME = 'onRegisterStudent';

	public function __construct(
		private readonly StudentEntity $studentEntity
	)
	{
	}

	public function getStudentEntity(): StudentEntity
	{
		return $this->studentEntity;
	}
}