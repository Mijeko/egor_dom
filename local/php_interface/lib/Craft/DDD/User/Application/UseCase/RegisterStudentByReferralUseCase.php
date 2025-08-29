<?php

namespace Craft\DDD\User\Application\UseCase;

use Craft\DDD\User\Application\Dto\RegisterStudentByRefDto;
use Craft\DDD\User\Application\Dto\RegisterStudentDto;
use Craft\DDD\User\Infrastructure\Events\InviteStudentToStudentEvent;
use Craft\DDD\User\Infrastructure\Service\EventManager;

class RegisterStudentByReferralUseCase
{

	public function __construct(
		protected RegisterStudentUseCase $registerService,
		protected EventManager           $eventManager,
	)
	{
	}

	public function execute(RegisterStudentByRefDto $dto): void
	{
		try
		{
			$studentEntity = $this->registerService->execute(new RegisterStudentDto(
				$dto->phone,
				$dto->email,
				$dto->password
			));

			$this->eventManager->dispatch(
				new InviteStudentToStudentEvent(
					$studentEntity,
					$dto->referralCode
				),
				InviteStudentToStudentEvent::EVENT_NAME
			);

		} catch(\Exception $exception)
		{
		}
	}
}