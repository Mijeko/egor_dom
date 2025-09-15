<?php

namespace Craft\DDD\User\Application\UseCase;

use Craft\DDD\Shared\Domain\ValueObject\EmailValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;
use Craft\DDD\User\Application\Dto\CreateManagerRequestDto;
use Craft\DDD\User\Application\Service\Interfaces\GroupAssignInterface;
use Craft\DDD\User\Application\Service\Interfaces\PasswordGeneratorInterface;
use Craft\DDD\User\Domain\Entity\ManagerEntity;
use Craft\DDD\User\Domain\Repository\ManagerRepositoryInterface;

class CreateManagerUseCase
{

	public function __construct(
		protected ManagerRepositoryInterface $managerRepository,
		protected GroupAssignInterface       $managerAssigner,
		protected PasswordGeneratorInterface $passwordGenerator,
	)
	{
	}

	public function execute(CreateManagerRequestDto $createManagerRequestDto): void
	{

		$manager = ManagerEntity::createManager(
			new EmailValueObject($createManagerRequestDto->email),
			new PhoneValueObject($createManagerRequestDto->phone),
			$this->passwordGenerator->generate(),
			$createManagerRequestDto->name,
			$createManagerRequestDto->lastName,
		);

		$manager = $this->managerRepository->create($manager);

		$this->managerAssigner->assign(
			[USER_GROUP_MANAGER],
			$manager->getId(),
		);
	}
}