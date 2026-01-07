<?php

namespace Craft\DDD\User\Application\Factory\UseCase;

use Craft\DDD\User\Application\UseCase\Crud\CreateManagerUseCase;
use Craft\DDD\User\Infrastructure\Repository\BxManagerRepository;
use Craft\DDD\User\Infrastructure\Service\GroupAssignService;
use Craft\DDD\User\Infrastructure\Service\PasswordGenerator;

class CreateManagerUseCaseFactory
{
	public static function getUseCase(): CreateManagerUseCase
	{
		return new CreateManagerUseCase(
			new BxManagerRepository(),
			new GroupAssignService(),
			new PasswordGenerator(),
		);
	}
}