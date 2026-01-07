<?php

namespace Craft\DDD\User\Application\UseCase\Crud;

use Craft\DDD\Shared\Domain\ValueObject\EmailValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PasswordValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;
use Craft\DDD\User\Application\Dto\Request\CreateStudentRequestDto;
use Craft\DDD\User\Application\Contract\GroupAssignInterface;
use Craft\DDD\User\Application\Contract\PasswordGeneratorInterface;
use Craft\DDD\User\Domain\Entity\StudentEntity;
use Craft\DDD\User\Domain\Repository\ManagerRepositoryInterface;
use Craft\DDD\User\Domain\Repository\StudentRepositoryInterface;

class CreateStudentUseCase
{

	public function __construct(
		protected StudentRepositoryInterface $studentRepository,
		protected ManagerRepositoryInterface $managerRepository,
		protected GroupAssignInterface       $groupAssign,
		protected PasswordGeneratorInterface $passwordGenerator,
	)
	{

	}

	public function execute(CreateStudentRequestDto $agentRequestDto): void
	{
		if(!$this->managerRepository->findById($agentRequestDto->managerId))
		{
			throw new \Exception("Выбранный менеджер не существует.");
		}

		$studentEntity = StudentEntity::createStudent(
			$agentRequestDto->name,
			$agentRequestDto->lastName,
			$agentRequestDto->secondName,
			new PhoneValueObject($agentRequestDto->phone),
			new EmailValueObject($agentRequestDto->email),
			$agentRequestDto->managerId,
			new PasswordValueObject($this->passwordGenerator->generate())
		);

		$studentEntity = $this->studentRepository->create($studentEntity);

		if(!$studentEntity->getId())
		{
			throw new \Exception('Ошибка при создании студента');
		}

		$this->groupAssign->assign(
			[USER_GROUP_AGENT],
			$studentEntity->getId()
		);
	}
}