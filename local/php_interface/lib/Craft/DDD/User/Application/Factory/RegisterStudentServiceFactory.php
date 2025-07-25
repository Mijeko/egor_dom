<?php

namespace Craft\DDD\User\Application\Factory;

use Craft\DDD\User\Application\Service\RegisterStudentService;
use Craft\DDD\User\Infrastructure\Repository\BxStudentRepository;
use Craft\DDD\User\Infrastructure\Service\AttachPhoneService;
use Craft\DDD\User\Infrastructure\Service\Authenticator;
use Craft\DDD\User\Infrastructure\Service\GroupAssignService;

class RegisterStudentServiceFactory
{
	public static function getService(): RegisterStudentService
	{
		return new RegisterStudentService(
			new BxStudentRepository(),
			new AttachPhoneService(),
			new Authenticator(),
			new GroupAssignService(),
		);
	}
}