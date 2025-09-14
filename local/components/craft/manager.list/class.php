<?php

use Craft\Core\Component\AjaxComponent;
use Craft\DDD\Shared\Application\Service\ImageServiceInterface;
use Craft\DDD\Shared\Infrastructure\Service\ImageService;
use Craft\DDD\User\Domain\Entity\ManagerEntity;
use Craft\DDD\User\Domain\Repository\ManagerRepositoryInterface;
use Craft\DDD\User\Infrastructure\Repository\BxManagerRepository;
use Craft\Dto\BxImageDto;
use Craft\Dto\BxUserDto;

class CraftManagerListComponent extends AjaxComponent
{

	protected ManagerRepositoryInterface $managerRepository;
	protected ImageServiceInterface $imageService;

	function componentNamespace(): string
	{
		return 'craftManagerList';
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
		$_managers = $this->managerRepository->findAll();

		$this->arResult['ITEMS'] = array_map(function(ManagerEntity $manager) {

			$avatar = null;
			if($manager->getAvatarId())
			{
				$_image = $this->imageService->findById($manager->getAvatarId());
				if($_image)
				{
					$avatar = new BxImageDto(
						$_image->id,
						$_image->src,
					);
				}
			}

			return BxUserDto::manager(
				$manager->getId(),
				$manager->getName(),
				$manager->getLastName(),
				$manager->getSecondName(),
				implode(' ', [
					$manager->getName(),
					$manager->getLastName(),
					$manager->getSecondName(),
				]),
				$manager->getEmail()->getValue(),
				$manager->getPhone()->getValue(),
				$avatar
			);
		}, $_managers);
	}

	public function loadServices(): void
	{
		$this->managerRepository = new BxManagerRepository();
		$this->imageService = new ImageService();
	}
}