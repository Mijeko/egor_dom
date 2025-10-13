<?php

namespace Craft\DDD\Notify\Application\Factory;

use Craft\DDD\Claims\Infrastructure\Repository\OrmManagerRepository;
use Craft\DDD\Notify\Application\Services\ManagerNotificatorService;
use Craft\DDD\Notify\Application\Factory\NotifyChannel\EmailNotifyChannelFactory;
use Craft\DDD\Notify\Application\Factory\NotifyChannel\TelegramNotifyChannelFactory;

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