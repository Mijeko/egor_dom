<?php

namespace Craft\DDD\Referal\Infrastructure\Events;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Referal\Application\Factory\InsertReferralMemberFactory;
use Craft\DDD\User\Infrastructure\Events\AuthorizeEvent;
use Symfony\Contracts\EventDispatcher\Event;

class AuthorizeListener
{
	public function handle(AuthorizeEvent $event): void
	{
		try
		{
			$user = $event->getUser();
			$insertReferralItemUseCase = InsertReferralMemberFactory::getUseCase();
			$insertReferralItemUseCase->execute($user->getId());
		} catch(\Exception $exception)
		{

		}

	}
}