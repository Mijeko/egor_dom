<?php

use Craft\DDD\User\Domain\Repository\AgentRepositoryInterface;
use Craft\DDD\User\Infrastructure\Repository\BxAgentRepository;
use Craft\DDD\User\Domain\Repository\ManagerRepositoryInterface;
use Craft\DDD\User\Infrastructure\Repository\BxManagerRepository;

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

			$this->loadServices();
			$this->loadData();

			$this->includeComponentTemplate();
		} catch(Exception $exception)
		{

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
			$manager = $this->managerRepository->findById($agent->getPersonalManagerId());

			$dto = new \Craft\Dto\BxUserDto(
				$agent->getId(),
				'',
				'',
				'',
				'',
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
				$manager,
			);
		}



		$this->arResult['USER'] = $dto;

		$this->arResult['APARTMENT_FILTER'] = \Craft\DDD\Developers\Infrastructure\Service\ApartmentFilterBuilder::fromUrl()->toArray();
	}
}