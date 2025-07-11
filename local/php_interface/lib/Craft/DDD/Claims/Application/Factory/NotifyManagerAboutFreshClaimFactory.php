<?php

namespace Craft\DDD\Claims\Application\Factory;

use Craft\DDD\Claims\Application\UseCase\NotifyManagerAboutFreshClaim;
use Craft\DDD\Claims\Infrastructure\TgNotifyService;

class NotifyManagerAboutFreshClaimFactory
{
	public static function getService(): NotifyManagerAboutFreshClaim
	{
		return new NotifyManagerAboutFreshClaim(
			new TgNotifyService(),
		);
	}
}