<?php

namespace Craft\DDD\Referal\Infrastructure\Listeners;

use Craft\DDD\Referal\Application\Dto\InsertReferralDto;
use Craft\DDD\Referal\Application\Factory\InsertReferralMemberFactory;
use Craft\DDD\Referal\Application\Factory\InviteUseCaseFactory;
use Craft\DDD\User\Application\Event\UserRegisterEvent;

class RegisterListener
{
	public function handle(UserRegisterEvent $event): void
	{
		$data = $event->getDto();

		$insertReferralItemUseCase = InsertReferralMemberFactory::getUseCase();
		$insertReferralItemUseCase->execute(new InsertReferralDto(
			$data->userId,
			$data->phone,
		));


		$invite = InviteUseCaseFactory::getUseCase();
		$invite->execute($data->userId);

	}
}