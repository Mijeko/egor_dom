<?php

namespace Craft\DDD\Claims\Application\Factory\NotifyChannel;

use Craft\DDD\Claims\Application\Services\NotifyChannel\EmailNotifyService;
use Craft\DDD\Claims\Infrastructure\Services\EmailSenderService;

class EmailNotifyChannelFactory
{
	public static function getService(): EmailNotifyService
	{
		return new EmailNotifyService(
			new EmailSenderService()
		);
	}
}