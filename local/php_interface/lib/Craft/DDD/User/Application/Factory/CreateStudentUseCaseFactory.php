<?php

namespace Craft\DDD\User\Application\Factory;

use Craft\DDD\User\Application\UseCase\CreateStudentUseCase;
use Craft\DDD\User\Infrastructure\Repository\BxStudentRepository;
use Craft\DDD\User\Infrastructure\Service\GroupAssignService;
use Craft\DDD\User\Infrastructure\Service\PasswordGenerator;

class CreateStudentUseCaseFactory
{
	public static function getUseCase(): CreateStudentUseCase
	{
		return new CreateStudentUseCase(
			new BxStudentRepository(),
			new GroupAssignService(),
			new PasswordGenerator(),
		);
	}
}