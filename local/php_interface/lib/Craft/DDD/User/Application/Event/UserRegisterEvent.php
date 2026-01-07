<?php

namespace Craft\DDD\User\Application\Event;

use Craft\DDD\User\Application\Dto\Event\UserRegisterEventDto;
use Symfony\Contracts\EventDispatcher\Event;

class UserRegisterEvent extends Event
{
	const string EVENT_NAME = 'userRegister';

	public function __construct(
		private UserRegisterEventDto $dto
	)
	{
	}

	public function getDto(): UserRegisterEventDto
	{
		return $this->dto;
	}
}