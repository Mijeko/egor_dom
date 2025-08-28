<?php

namespace Craft\DDD\User\Application\UseCase;

use Craft\DDD\User\Application\Dto\RegisterStudentByRefDto;
use Craft\DDD\User\Application\Dto\RegisterStudentDto;
use Craft\DDD\User\Application\Service\Interfaces\AuthenticatorInterface;
use Craft\DDD\User\Application\Service\Interfaces\GroupAssignInterface;
use Craft\DDD\User\Domain\Repository\StudentRepositoryInterface;
use Craft\DDD\User\Infrastructure\Events\RegisterStudentEvent;
use Craft\DDD\User\Infrastructure\Service\AttachPhoneService;
use Craft\DDD\User\Infrastructure\Service\EventManager;

class RegisterStudentByReferralUseCase extends RegisterStudentUseCase
{

	public function __construct(
		StudentRepositoryInterface $studentRepository,
		AttachPhoneService         $attachPhoneService,
		AuthenticatorInterface     $authenticator,
		GroupAssignInterface       $groupAssignService,
		protected EventManager     $eventManager,
	)
	{
		parent::__construct($studentRepository, $attachPhoneService, $authenticator, $groupAssignService);
	}


	public function registerByReferral(RegisterStudentByRefDto $dto): void
	{
		try
		{
			$studentEntity = $this->execute(new RegisterStudentDto(
				$dto->phone,
				$dto->email,
				$dto->password
			));

			$this->eventManager->dispatch(
				new RegisterStudentEvent($studentEntity),
				RegisterStudentEvent::EVENT_NAME
			);

		} catch(\Exception $exception)
		{
		}
	}
}