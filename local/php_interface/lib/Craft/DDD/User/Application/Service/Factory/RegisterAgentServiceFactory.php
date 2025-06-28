<?php

namespace Craft\DDD\User\Application\Service\Factory;

use Craft\DDD\User\Application\Service\RegisterAgentService;
use Craft\DDD\User\Infrastructure\Repository\BxAgentRepository;

class RegisterAgentServiceFactory
{
	public static function getService(): RegisterAgentService
	{
		return new RegisterAgentService(
			new BxAgentRepository()
		);
	}
}