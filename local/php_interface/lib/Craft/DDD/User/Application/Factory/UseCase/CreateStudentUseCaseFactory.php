<?php

namespace Craft\DDD\User\Application\Factory\UseCase;

use Craft\DDD\User\Application\UseCase\Crud\CreateStudentUseCase;
use Craft\DDD\User\Infrastructure\Repository\BxManagerRepository;
use Craft\DDD\User\Infrastructure\Repository\BxStudentRepository;
use Craft\DDD\User\Infrastructure\Service\GroupAssignService;
use Craft\DDD\User\Infrastructure\Service\PasswordGenerator;

class CreateStudentUseCaseFactory
{
	public static function getUseCase(): CreateStudentUseCase
	{
		return new CreateStudentUseCase(
			new BxStudentRepository(),
			new BxManagerRepository(),
			new GroupAssignService(),
			new PasswordGenerator(),
		);
	}
}