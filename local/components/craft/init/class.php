<?php

use Bitrix\Main\Diag\Debug;
use Craft\DDD\User\Domain\Repository\ExternalRealtorRepositoryInterface;
use Craft\DDD\User\Infrastructure\Dto\ManagerDto;
use Craft\DDD\User\Domain\Repository\AgentRepositoryInterface;
use Craft\DDD\User\Infrastructure\Repository\BxAgentRepository;
use Craft\DDD\User\Domain\Repository\ManagerRepositoryInterface;
use Craft\DDD\User\Infrastructure\Repository\BxManagerRepository;
use Craft\DDD\Developers\Infrastructure\Service\ApartmentFilterBuilder;
use Craft\DDD\User\Infrastructure\Repository\ExternalRealtorRepository;
use Craft\Dto\BxUserDto;

class CraftInitComponent extends CBitrixComponent
{
	protected AgentRepositoryInterface $agentRepository;
	protected ManagerRepositoryInterface $managerRepository;
	protected ExternalRealtorRepositoryInterface $externalRealtorRepository;

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
			throw new Exception('');
		}
	}

	private function loadServices(): void
	{
		$this->agentRepository = new BxAgentRepository();
		$this->managerRepository = new BxManagerRepository();
		$this->externalRealtorRepository = new ExternalRealtorRepository();
	}

	private function loadData(): void
	{
		$dto = null;
		$agent = $this->agentRepository->findById($this->arParams['USER_ID']);
		if($agent)
		{

			$managerDto = null;
			$manager = $this->managerRepository->findById($agent->getPersonalManagerId());
			if($manager)
			{
				$managerDto = ManagerDto::fromEntity($manager);
			}

			$dto = new BxUserDto(
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
			);
		}

		if(!$dto)
		{
			$extRealtor = $this->externalRealtorRepository->findById($this->arParams['USER_ID']);
			if($extRealtor)
			{
				$dto = new BxUserDto(
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
				);
			}
		}


		$this->arResult['USER'] = $dto;

		$this->arResult['APARTMENT_FILTER'] = ApartmentFilterBuilder::fromUrl()->toArray();
	}
}