<?php

namespace Craft\DDD\User\Application\Factory\UseCase;

use Craft\DDD\User\Application\Factory\UseCase\RegisterStudentUseCaseFactory;
use Craft\DDD\User\Application\UseCase\Register\RegisterStudentByReferralUseCase;
use Craft\DDD\User\Infrastructure\Repository\BxStudentRepository;
use Craft\DDD\User\Infrastructure\Service\AttachPhoneService;
use Craft\DDD\User\Infrastructure\Service\Authenticator;
use Craft\DDD\User\Infrastructure\Service\EventManagerInterface;
use Craft\DDD\User\Infrastructure\Service\GroupAssignService;

class RegisterStudentByReferralUseCaseFactory
{
	public static function getUseCase(): RegisterStudentByReferralUseCase
	{
		return new RegisterStudentByReferralUseCase(
			RegisterStudentUseCaseFactory::getUseCase(),
			new EventManagerInterface(),
		);
	}
}