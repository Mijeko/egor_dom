<?php

namespace Craft\DDD\Referal\Infrastructure\Listeners;

use Craft\DDD\Referal\Application\Factory\InsertReferralMemberFactory;
use Craft\DDD\User\Infrastructure\Events\RegisterStudentEvent;

class RegisterStudentListener
{
	public function handle(RegisterStudentEvent $event): void
	{
		try
		{
			$user = $event->getStudentEntity();
			$insertReferralItemUseCase = InsertReferralMemberFactory::getUseCase();
			$insertReferralItemUseCase->execute($user->getId());
		} catch(\Exception $e)
		{
		}
	}
}