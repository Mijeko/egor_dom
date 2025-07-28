<?php

namespace Craft\DDD\User\Application\Factory;

use Craft\DDD\User\Application\UseCase\RegisterAgentUseCase;
use Craft\DDD\User\Infrastructure\Factory\ManagerAssignerFactory;
use Craft\DDD\User\Infrastructure\Repository\BxAgentRepository;
use Craft\DDD\User\Infrastructure\Service\AttachPhoneService;
use Craft\DDD\User\Infrastructure\Service\Authenticator;
use Craft\DDD\User\Infrastructure\Service\GroupAssignService;

class RegisterAgentUseCaseFactory
{
	public static function getService(): RegisterAgentUseCase
	{
		return new RegisterAgentUseCase(
			new BxAgentRepository(),
			new AttachPhoneService(),
			new Authenticator(),
			new GroupAssignService(),
			ManagerAssignerFactory::getService()
		);
	}
}