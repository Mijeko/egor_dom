<?php

namespace Craft\DDD\User\Application\Factory;

use Craft\DDD\User\Application\UseCase\RegisterAgentService;
use Craft\DDD\User\Infrastructure\Repository\BxAgentRepository;
use Craft\DDD\User\Infrastructure\Service\AttachPhoneService;
use Craft\DDD\User\Infrastructure\Service\Authenticator;
use Craft\DDD\User\Infrastructure\Service\GroupAssignService;

class RegisterAgentServiceFactory
{
	public static function getService(): RegisterAgentService
	{
		return new RegisterAgentService(
			new BxAgentRepository(),
			new AttachPhoneService(),
			new Authenticator(),
			new GroupAssignService(),
		);
	}
}