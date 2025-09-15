<?php

use Craft\Core\Component\AjaxComponent;
use Craft\DDD\Shared\Application\Service\ImageServiceInterface;
use Craft\DDD\Shared\Infrastructure\Service\ImageService;
use Craft\DDD\User\Domain\Repository\ManagerRepositoryInterface;
use Craft\DDD\User\Infrastructure\Repository\BxManagerRepository;
use Craft\Dto\BxImageDto;
use Craft\Dto\BxUserDto;

class CraftManagerEditComponent extends AjaxComponent
{

	protected ?ManagerRepositoryInterface $managerRepository;
	protected ImageServiceInterface $imageService;

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


		$avatar = null;
		if($_manager->getAvatarId())
		{
			$_image = $this->imageService->findById($_manager->getAvatarId());
			if($_image)
			{
				$avatar = new BxImageDto(
					$_image->id,
					$_image->src,
				);
			}
		}

		$this->arResult['MANAGER'] = BxUserDto::manager(
			$_manager->getId(),
			$_manager->getName(),
			$_manager->getLastName(),
			$_manager->getSecondName(),
			$_manager->fullName(),
			$_manager->getEmail()->getValue(),
			$_manager->getPhone()->getValue(),
			$avatar
		);

		global $APPLICATION;
		$APPLICATION->SetTitle('Редактирование: ' . $_manager->fullName());
	}

	public function loadServices(): void
	{
		$this->managerRepository = new BxManagerRepository();
		$this->imageService = new ImageService();
	}
}