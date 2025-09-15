<?php

namespace Craft\DDD\User\Application\Factory;

use Craft\DDD\User\Application\UseCase\CreateAgentUseCase;
use Craft\DDD\User\Infrastructure\Factory\ManagerAssignerFactory;
use Craft\DDD\User\Infrastructure\Repository\BxAgentRepository;
use Craft\DDD\User\Infrastructure\Service\GroupAssignService;
use Craft\DDD\User\Infrastructure\Service\PasswordGenerator;

class CreateAgentUseCaseFactory
{
	public static function createUseCase(): CreateAgentUseCase
	{
		return new CreateAgentUseCase(
			new BxAgentRepository(),
			new GroupAssignService(),
			new PasswordGenerator(),
		);
	}
}