<?php

namespace Craft\DDD\User\Application\Factory;

use Craft\DDD\User\Application\UseCase\RegisterStudentUseCase;
use Craft\DDD\User\Infrastructure\Repository\BxStudentRepository;
use Craft\DDD\User\Infrastructure\Service\AttachPhoneService;
use Craft\DDD\User\Infrastructure\Service\Authenticator;
use Craft\DDD\User\Infrastructure\Service\GroupAssignService;

class RegisterStudentUseCaseFactory
{
	public static function getUseCase(): RegisterStudentUseCase
	{
		return new RegisterStudentUseCase(
			new BxStudentRepository(),
			new AttachPhoneService(),
			new Authenticator(),
			new GroupAssignService(),
		);
	}
}