<?php

namespace Craft\DDD\User\Infrastructure\Factory;

use Craft\DDD\User\Application\Service\Interfaces\ManagerAssignerInterface;
use Craft\DDD\User\Infrastructure\Repository\BxAgentRepository;
use Craft\DDD\User\Infrastructure\Repository\BxManagerRepository;
use Craft\DDD\User\Infrastructure\Service\ManagerAssigner;

class ManagerAssignerFactory
{
	public static function getService(): ManagerAssignerInterface
	{
		return new ManagerAssigner(
			new BxManagerRepository(),
			new BxAgentRepository()
		);
	}
}