<?php

namespace Craft\DDD\User\Infrastructure\Events;

use Craft\DDD\User\Domain\Entity\StudentEntity;
use Craft\DDD\User\Domain\Entity\UserEntity;
use Symfony\Contracts\EventDispatcher\Event;

class InviteStudentToStudentEvent extends Event
{

	const string EVENT_NAME = 'onInviteStudentToStudent';

	public function __construct(
		private readonly StudentEntity $studentEntity,
		private readonly string        $referralCode,
	)
	{
	}

	public function getStudentEntity(): StudentEntity
	{
		return $this->studentEntity;
	}

	public function getReferralCode(): string
	{
		return $this->referralCode;
	}
}