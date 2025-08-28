<?php

namespace Craft\DDD\Referal\Infrastructure\Listeners;

use Craft\DDD\Referal\Application\Dto\JoinClientToClientDto;
use Craft\DDD\Referal\Application\Factory\InviteClientUseCaseFactory;
use Craft\DDD\User\Infrastructure\Events\InviteStudentToStudentEvent;

class InviteStudentToStudentListener
{
	public function handle(InviteStudentToStudentEvent $event): void
	{
		try
		{
			$user = $event->getStudentEntity();
			$refCode = $event->getReferralCode();

			$insertReferralItemUseCase = InviteClientUseCaseFactory::getUseCase();
			$insertReferralItemUseCase->execute(
				new JoinClientToClientDto(
					rand(),
					$user->getPhone()->getValue(),
					$refCode,
				)
			);


		} catch(\Exception $e)
		{
		}
	}
}