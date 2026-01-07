<?php

namespace Craft\DDD\User\Application\UseCase\Register;

use Craft\DDD\User\Application\Dto\RegisterStudentByRefDto;
use Craft\DDD\User\Application\Dto\RegisterStudentDto;
use Craft\DDD\User\Application\UseCase\Register\RegisterStudentUseCase;
use Craft\DDD\User\Infrastructure\Events\InviteStudentToStudentEvent;
use Craft\DDD\User\Infrastructure\Service\EventManagerInterface;

class RegisterStudentByReferralUseCase
{

	public function __construct(
		protected RegisterStudentUseCase $registerStudentUseCase,
		protected EventManagerInterface  $eventManager,
	)
	{
	}

	public function execute(RegisterStudentByRefDto $dto): void
	{
		try
		{
			$studentEntity = $this->registerStudentUseCase->execute(new RegisterStudentDto(
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