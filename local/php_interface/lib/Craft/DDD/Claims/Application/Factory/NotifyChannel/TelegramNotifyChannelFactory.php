<?php

namespace Craft\DDD\Claims\Application\Factory\NotifyChannel;

use Craft\DDD\Claims\Application\Services\NotifyChannel\TelegramNotifyService;
use Craft\DDD\Claims\Infrastructure\Services\TgSenderService;

class TelegramNotifyChannelFactory
{
	public static function getService(): TelegramNotifyService
	{
		return new TelegramNotifyService(
			new TgSenderService()
		);
	}
}