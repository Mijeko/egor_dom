<?php

namespace Craft\DDD\User\Application\UseCase;

use Craft\DDD\Shared\Domain\ValueObject\EmailValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PasswordValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;
use Craft\DDD\User\Application\Dto\RegisterStudentDto;
use Craft\DDD\User\Application\Service\Interfaces\AuthenticatorInterface;
use Craft\DDD\User\Application\Service\Interfaces\GroupAssignInterface;
use Craft\DDD\User\Domain\Entity\StudentEntity;
use Craft\DDD\User\Domain\Repository\StudentRepositoryInterface;
use Craft\DDD\User\Infrastructure\Service\AttachPhoneService;

class RegisterStudentUseCase
{
	public function __construct(
		protected StudentRepositoryInterface $studentRepository,
		protected AttachPhoneService         $attachPhoneService,
		protected AuthenticatorInterface     $authenticator,
		protected GroupAssignInterface       $groupAssignService,
	)
	{
	}

	public function execute(RegisterStudentDto $registerStudentDto): StudentEntity
	{
		$specialPhone = \COption::GetOptionString('main', 'new_user_phone_auth') == 'Y';

		if($specialPhone)
		{
			if($this->attachPhoneService->isExist($registerStudentDto->phone))
			{
				throw new \Exception("Пользователь с таким номером телефона уже существует");
			}
		} else
		{
			if($this->studentRepository->findByPhone(new PhoneValueObject($registerStudentDto->phone)))
			{
				throw new \Exception("Пользователь с таким номером телефона уже существует");
			}
		}


		$student = StudentEntity::register(
			new PhoneValueObject($registerStudentDto->phone),
			new EmailValueObject($registerStudentDto->email),
			new PasswordValueObject($registerStudentDto->password),
		);


		$student = $this->studentRepository->create($student);

		if($specialPhone)
		{
			$this->attachPhoneService->attach(
				$student->getId(),
				$student->getPhone()->getValue()
			);
		}

		$this->groupAssignService->assign(
			[USER_GROUP_STUDENT],
			$student->getId(),
		);

		$this->authenticator->loginById($student->getId());

		return $student;
	}
}