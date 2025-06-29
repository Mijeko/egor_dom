<?php

namespace Craft\DDD\User\Application\Service\Factory;

use Craft\DDD\User\Application\Service\RegisterStudentService;
use Craft\DDD\User\Infrastructure\Repository\BxStudentRepository;

class RegisterStudentServiceFactory
{
	public static function getService(): RegisterStudentService
	{
		return new RegisterStudentService(
			new BxStudentRepository()
		);
	}
}