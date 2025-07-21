<?php

namespace Craft\DDD\Claims\Application\Factory;

use Craft\DDD\Claims\Infrastructure\Repository\OrmManagerRepository;
use Craft\DDD\Claims\Application\Services\ManagerNotificatorService;
use Craft\DDD\Claims\Application\Factory\NotifyChannel\EmailNotifyChannelFactory;
use Craft\DDD\Claims\Application\Factory\NotifyChannel\TelegramNotifyChannelFactory;

class ManagerNotificatorServiceFactory
{
	public static function getService(): ManagerNotificatorService
	{
		return new ManagerNotificatorService(
			new OrmManagerRepository(),
			TelegramNotifyChannelFactory::getService(),
			EmailNotifyChannelFactory::getService(),
		);
	}
}