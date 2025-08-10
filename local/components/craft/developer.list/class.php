<?php

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Developers\Domain\Entity\DeveloperEntity;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\City\Infrastructure\Service\CurrentCityService;
use Craft\DDD\Developers\Application\Service\DeveloperService;
use Craft\DDD\Developers\Infrastructure\Entity\DeveloperTable;
use Craft\DDD\Developers\Application\Service\BuildObjectService;
use Craft\DDD\City\Infrastructure\Factory\CurrentCityServiceFactory;
use Craft\DDD\Developers\Application\Factory\DeveloperServiceFactory;
use Craft\DDD\Developers\Application\Factory\BuildObjectServiceFactory;
use Craft\DDD\Developers\Present\Dto\DeveloperListItemDto;
use Craft\Dto\BxImageDto;

class CraftDeveloperListComponent extends CBitrixComponent
{
	protected ?DeveloperService $developerService = null;
	protected ?BuildObjectService $buildObjectService = null;
	protected ?CurrentCityService $currentCityService = null;

	public function executeComponent()
	{
		try
		{
			$this->loadServices();
			$this->loadData();
			$this->includeComponentTemplate();
		} catch(Exception $e)
		{
			Debug::dump($e->getMessage());
		}
	}

	protected function loadServices(): void
	{
		$this->currentCityService = CurrentCityServiceFactory::getService();
		$this->developerService = DeveloperServiceFactory::createOnOrm();
		$this->buildObjectService = BuildObjectServiceFactory::createOnOrm();
	}

	protected function loadData(): void
	{

		$developerList = $this->developerService->findAll(
			[],
			[
				DeveloperTable::F_CITY_ID => $this->currentCityService->current()->getId(),
			]
		);


		$developerIdList = array_map(function(DeveloperEntity $developer) {
			return $developer->getId();
		}, $developerList);

		$buildObjectList = $this->buildObjectService->findAllByDeveloperIds($developerIdList);
		$buildObjectListReduced = array_reduce($buildObjectList, function(array $carry, BuildObjectEntity $item) {
			$carry[$item->getDeveloperId()][] = $item;
			return $carry;
		}, []);


		$this->arResult['DEVELOPERS'] = array_map(function(DeveloperEntity $developer) use ($buildObjectListReduced) {

			$imageDto = null;
			if($picture = $developer->getPicture())
			{
				$imageDto = new BxImageDto(
					$picture->getId(),
					$picture->getSrc()
				);
			}

			return new DeveloperListItemDto(
				$developer->getId(),
				$developer->getName(),
				$imageDto,
				count($buildObjectListReduced[$developer->getId()] ?? []),
			);
		}, $developerList);

	}
}