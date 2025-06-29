<?php

namespace Craft\DDD\User\Application\Service;

use Craft\DDD\Shared\Domain\ValueObject\EmailValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PasswordValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;
use Craft\DDD\User\Application\Dto\RegisterStudentDto;
use Craft\DDD\User\Domain\Entity\StudentEntity;
use Craft\DDD\User\Domain\Repository\StudentRepositoryInterface;

class RegisterStudentService
{
	public function __construct(
		protected StudentRepositoryInterface $studentRepository
	)
	{
	}

	public function execute(RegisterStudentDto $registerStudentDto): ?StudentEntity
	{
		if($this->studentRepository->findByPhone(new PhoneValueObject($registerStudentDto->phone)))
		{
			throw new \Exception("Пользователь с таким номером телефона уже существует");
		}


		$student = StudentEntity::register(
			new PhoneValueObject($registerStudentDto->phone),
			new EmailValueObject($registerStudentDto->email),
			new PasswordValueObject($registerStudentDto->password),
		);


		return $this->studentRepository->create($student);
	}
}