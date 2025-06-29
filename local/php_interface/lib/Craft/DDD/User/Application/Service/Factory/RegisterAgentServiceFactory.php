<?php

namespace Craft\DDD\User\Application\Service\Factory;

use Craft\DDD\User\Application\Service\RegisterAgentService;
use Craft\DDD\User\Infrastructure\Repository\BxAgentRepository;
use Craft\DDD\User\Infrastructure\Service\AttachPhoneService;
use Craft\DDD\User\Infrastructure\Service\Autenficator;

class RegisterAgentServiceFactory
{
	public static function getService(): RegisterAgentService
	{
		return new RegisterAgentService(
			new BxAgentRepository(),
			new AttachPhoneService(),
			new Autenficator(),
		);
	}
}