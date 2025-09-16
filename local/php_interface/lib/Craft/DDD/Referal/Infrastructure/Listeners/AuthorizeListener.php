<?php

namespace Craft\DDD\Referal\Infrastructure\Listeners;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Referal\Application\Dto\InsertReferralDto;
use Craft\DDD\Referal\Application\Factory\InsertReferralMemberFactory;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;
use Craft\DDD\User\Infrastructure\Events\AuthorizeEvent;
use Symfony\Contracts\EventDispatcher\Event;

class AuthorizeListener
{
	public function handle(AuthorizeEvent $event): void
	{
		try
		{
			$userEntity = $event->getUser();

			$insertReferralItemUseCase = InsertReferralMemberFactory::getUseCase();

			$insertReferralItemUseCase->execute(new InsertReferralDto(
				$userEntity->getId(),
				$userEntity->getPhone()->getValue(),
			));


		} catch(\Exception $exception)
		{
			Debug::dumpToFile($exception->getMessage());
		}

	}
}