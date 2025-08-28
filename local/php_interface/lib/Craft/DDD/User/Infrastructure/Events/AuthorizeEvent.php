<?php

namespace Craft\DDD\User\Infrastructure\Events;

use Craft\DDD\User\Domain\Entity\UserEntity;
use Symfony\Contracts\EventDispatcher\Event;

class AuthorizeEvent extends Event
{
	const string EVENT_NAME = 'onAuthorize';

	public function __construct(
		private readonly UserEntity $user
	)
	{
	}

	public function getUser(): UserEntity
	{
		return $this->user;
	}
}