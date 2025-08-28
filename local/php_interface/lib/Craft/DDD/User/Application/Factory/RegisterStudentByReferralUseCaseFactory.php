<?php

namespace Craft\DDD\User\Application\Factory;

use Craft\DDD\User\Application\UseCase\RegisterStudentByReferralUseCase;
use Craft\DDD\User\Infrastructure\Repository\BxStudentRepository;
use Craft\DDD\User\Infrastructure\Service\AttachPhoneService;
use Craft\DDD\User\Infrastructure\Service\Authenticator;
use Craft\DDD\User\Infrastructure\Service\GroupAssignService;

class RegisterStudentByReferralUseCaseFactory
{
	public static function getUseCase(): RegisterStudentByReferralUseCase
	{
		return new RegisterStudentByReferralUseCase(
			new BxStudentRepository(),
			new AttachPhoneService(),
			new Authenticator(),
			new GroupAssignService(),
		);
	}
}