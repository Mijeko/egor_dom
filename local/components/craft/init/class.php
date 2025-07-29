<?php

use Craft\DDD\User\Infrastructure\Dto\ManagerDto;
use Craft\DDD\User\Domain\Repository\AgentRepositoryInterface;
use Craft\DDD\User\Infrastructure\Repository\BxAgentRepository;
use Craft\DDD\User\Domain\Repository\ManagerRepositoryInterface;
use Craft\DDD\User\Infrastructure\Repository\BxManagerRepository;
use Craft\DDD\Developers\Infrastructure\Service\ApartmentFilterBuilder;

class CraftInitComponent extends CBitrixComponent
{
	protected AgentRepositoryInterface $agentRepository;
	protected ManagerRepositoryInterface $managerRepository;

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

			$dto = new \Craft\Dto\BxUserDto(
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


		$this->arResult['USER'] = $dto;

		$this->arResult['APARTMENT_FILTER'] = ApartmentFilterBuilder::fromUrl()->toArray();
	}
}