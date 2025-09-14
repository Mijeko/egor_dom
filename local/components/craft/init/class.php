<?php

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Shared\Application\Service\ImageServiceInterface;
use Craft\DDD\Shared\Infrastructure\Service\ImageService;
use Craft\DDD\User\Application\Factory\UserServiceFactory;
use Craft\DDD\User\Application\Service\UserService;
use Craft\DDD\User\Domain\Repository\ExternalRealtorRepositoryInterface;
use Craft\DDD\User\Domain\Repository\UserRepositoryInterface;
use Craft\DDD\User\Infrastructure\Dto\ManagerDto;
use Craft\DDD\User\Domain\Repository\AgentRepositoryInterface;
use Craft\DDD\User\Infrastructure\Repository\BxAgentRepository;
use Craft\DDD\User\Domain\Repository\ManagerRepositoryInterface;
use Craft\DDD\User\Infrastructure\Repository\BxManagerRepository;
use Craft\DDD\Developers\Infrastructure\Service\ApartmentFilterBuilder;
use Craft\DDD\User\Infrastructure\Repository\BxUserRepository;
use Craft\DDD\User\Infrastructure\Repository\ExternalRealtorRepository;
use Craft\Dto\BxImageDto;
use Craft\Dto\BxUserDto;

class CraftInitComponent extends CBitrixComponent
{
	protected AgentRepositoryInterface $agentRepository;
	protected ManagerRepositoryInterface $managerRepository;
	protected ExternalRealtorRepositoryInterface $externalRealtorRepository;

	protected UserRepositoryInterface $userRepository;
	protected UserService $service;

	protected ImageServiceInterface $imageService;

	public function onPrepareComponentParams($arParams)
	{
		return $arParams;
	}

	public function executeComponent()
	{
		try
		{
			$this->check();
			$this->loadServices();
			$this->loadData();

			$this->includeComponentTemplate();
		} catch(Exception $exception)
		{
			Debug::dumpToFile($exception->getMessage());
		}
	}

	private function check(): void
	{
		if(!$this->arParams['USER_ID'])
		{
			throw new Exception('Не передан параметр User ID');
		}
	}

	private function loadServices(): void
	{
		$this->agentRepository = new BxAgentRepository();
		$this->managerRepository = new BxManagerRepository();
		$this->externalRealtorRepository = new ExternalRealtorRepository();
		$this->userRepository = new BxUserRepository();
		$this->imageService = new ImageService();
		$this->service = UserServiceFactory::getService();
	}

	private function loadData(): void
	{
		$dto = null;

		$mainUser = $this->service->findById($this->arParams['USER_ID']);


		if($mainUser->isAdmin())
		{

		}

		if($mainUser->isManager())
		{
			$manager = $this->managerRepository->findById($this->arParams['USER_ID']);
			if($manager)
			{
				$avatar = null;
				if($manager->getAvatarId())
				{
					$_avatar = $this->imageService->findById($manager->getAvatarId());
					if($_avatar)
					{
						$avatar = new BxImageDto($_avatar->id, $_avatar->src);
					}
				}

				$dto = BxUserDto::manager(
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
					$avatar,
				);
			}

		}

		if($mainUser->isAgent())
		{

			$agent = $this->agentRepository->findById($this->arParams['USER_ID']);
			if($agent)
			{
				$managerDto = null;
				$manager = $this->managerRepository->findById($agent->getPersonalManagerId());
				if($manager)
				{
					$managerDto = ManagerDto::fromEntity($manager);
				}
				$avatar = null;
				if($manager->getAvatarId())
				{
					$_avatar = $this->imageService->findById($manager->getAvatarId());
					if($_avatar)
					{
						$avatar = new BxImageDto($_avatar->id, $_avatar->src);
					}
				}

				$dto = BxUserDto::agent(
					$agent->getId(),
					$agent->getName(),
					$agent->getLastName(),
					$agent->getSecondName(),
					implode(' ', [
						$agent->getName(),
						$agent->getLastName(),
						$agent->getSecondName(),
					]),
					$agent->getEmail()->getValue(),
					$agent->getPhone()->getValue(),
					$agent->getInn()->getValue(),
					$agent->getOgrn()->getValue(),
					$agent->getKpp()->getValue(),
					$agent->getBik()->getValue(),
					$agent->getCurrAcc()->getValue(),
					$agent->getCorrAcc()->getValue(),
					$agent->getLegalAddress(),
					$agent->getPostAddress(),
					$agent->getBankName(),
					$managerDto,
					$avatar
				);
			}
		}


		if(!$dto)
		{
			$extRealtor = $this->externalRealtorRepository->findById($this->arParams['USER_ID']);
			if($extRealtor)
			{

				$avatar = null;
				$_image = $this->imageService->findById($extRealtor->getAvatarId());
				if($_image)
				{
					$avatar = new BxImageDto(
						$_image->id,
						$_image->src,
					);
				}

				$dto = BxUserDto::extRealtor(
					$extRealtor->getId(),
					$extRealtor->getName(),
					$extRealtor->getLastName(),
					$extRealtor->getSecondName(),
					implode(' ', [
						$extRealtor->getName(),
						$extRealtor->getLastName(),
						$extRealtor->getSecondName(),
					]),
					$extRealtor->getEmail()->getValue(),
					$extRealtor->getPhone()->getValue(),
					$avatar,
				);
			}
		}

		$this->arResult['USER'] = $dto;

		$this->arResult['APARTMENT_FILTER'] = ApartmentFilterBuilder::fromUrl()->toArray();
	}
}