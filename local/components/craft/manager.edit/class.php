<?php

use Craft\Core\Component\AjaxComponent;
use Craft\DDD\User\Domain\Repository\ManagerRepositoryInterface;
use Craft\DDD\User\Infrastructure\Repository\BxManagerRepository;
use Craft\Dto\BxUserDto;

class CraftManagerEditComponent extends AjaxComponent
{

	protected ?ManagerRepositoryInterface $managerRepository;

	function componentNamespace(): string
	{
		return 'craftManagerEdit';
	}

	protected function validate(array $postData): void
	{
	}

	protected function work(array $formData): void
	{
	}

	protected function modules(): ?array
	{
		return [];
	}

	protected function loadData(): void
	{

		$_manager = $this->managerRepository->findById($this->arParams['ID']);

		if(!$_manager)
		{
			throw new Exception('Менеджер не найден');
		}

		$this->arResult['MANAGER'] = BxUserDto::manager(
			$_manager->getId(),
			$_manager->getName(),
			$_manager->getLastName(),
			$_manager->getSecondName(),
			$_manager->fullName(),
			$_manager->getEmail()->getValue(),
			$_manager->getPhone()->getValue(),
		);

		global $APPLICATION;
		$APPLICATION->SetTitle('Редактирование: ' . $_manager->fullName());
	}

	public function loadServices(): void
	{
		$this->managerRepository = new BxManagerRepository();
	}
}