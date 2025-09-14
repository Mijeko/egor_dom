<?php

use Craft\Core\Component\AjaxComponent;
use Craft\Core\Rest\ResponseBx;
use Craft\DDD\Shared\Domain\ValueObject\EmailValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;
use Craft\DDD\User\Application\Service\Interfaces\GroupAssignInterface;
use Craft\DDD\User\Application\Service\Interfaces\PasswordGeneratorInterface;
use Craft\DDD\User\Domain\Entity\ManagerEntity;
use Craft\DDD\User\Domain\Repository\ManagerRepositoryInterface;
use Craft\DDD\User\Infrastructure\Repository\BxManagerRepository;
use Craft\DDD\User\Infrastructure\Service\GroupAssignService;
use Craft\DDD\User\Infrastructure\Service\PasswordGenerator;

class CraftManagerCreateComponent extends AjaxComponent
{

	protected ManagerRepositoryInterface $managerRepository;
	protected GroupAssignInterface $managerAssigner;
	protected PasswordGeneratorInterface $passwordGenerator;

	function componentNamespace(): string
	{
		return "craftManagerCreate";
	}

	protected function validate(array $postData): void
	{
	}

	protected function work(array $formData): void
	{
		try
		{
			$manager = ManagerEntity::createManager(
				new EmailValueObject($formData['email']),
				new PhoneValueObject($formData['phone']),
				$this->passwordGenerator->generate(),
				$formData['name'],
				$formData['lastName'],
			);

			$manager = $this->managerRepository->create($manager);

			$this->managerAssigner->assign(
				[USER_GROUP_MANAGER],
				$manager->getId(),
			);

			ResponseBx::success([]);

		} catch(Exception $e)
		{
			ResponseBx::badRequest($e->getMessage());
		}
	}

	protected function modules(): ?array
	{
		return [];
	}

	protected function loadData(): void
	{
	}

	public function loadServices(): void
	{
		$this->managerRepository = new BxManagerRepository();
		$this->managerAssigner = new GroupAssignService();
		$this->passwordGenerator = new PasswordGenerator();
	}
}