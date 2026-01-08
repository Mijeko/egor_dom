<?php

namespace Craft\DDD\Referal\Infrastructure\Listeners;

use Craft\DDD\Referal\Application\Dto\InviteDto;
use Craft\DDD\Referal\Application\Factory\InviteUseCaseFactory;
use Craft\DDD\User\Infrastructure\Events\InviteStudentToStudentEvent;

class InviteStudentToStudentListener
{
	public function handle(InviteStudentToStudentEvent $event): void
	{
		try
		{
			$user = $event->getStudentEntity();
			$refCode = $event->getReferralCode();

			$insertReferralItemUseCase = InviteUseCaseFactory::getUseCase();
			$insertReferralItemUseCase->execute(
				new InviteDto(
					$user->getPhone()->getValue(),
					$refCode,
				)
			);


		} catch(\Exception $e)
		{
		}
	}
}