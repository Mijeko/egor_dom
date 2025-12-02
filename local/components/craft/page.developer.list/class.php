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
use Craft\DDD\Developers\Present\Dto\BuildObjectDto;
use Craft\DDD\Developers\Present\Dto\DeveloperDto;
use Craft\DDD\Developers\Present\Dto\DeveloperListItemDto;
use Craft\Dto\BxImageDto;
use Craft\Helper\Criteria;

class CraftPageDeveloperListComponent extends CBitrixComponent
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
		$developerList = $this->developerService->findAll(Criteria::instance()->filter([
			DeveloperTable::F_CITY_ID => $this->currentCityService->current()->getId(),
		]));


		$developerIdList = array_map(fn(DeveloperEntity $developer) => $developer->getId(), $developerList);
		$buildObjectList = $this->buildObjectService->findAllByDeveloperIds($developerIdList);


		$this->arResult['DEVELOPERS'] = array_map(function(DeveloperEntity $developer) use ($buildObjectList) {

			$developerDto = DeveloperDto::fromModel($developer);

			if($picture = $developer->getPicture())
			{
				$developerDto->picture = new BxImageDto(
					$picture->getId(),
					$picture->getSrc()
				);
			}

			$buildObjectList = array_filter($buildObjectList, fn(BuildObjectDto $el) => $el->developer->id === $developer->getId());
			$buildObjectList = array_values($buildObjectList);

			return new DeveloperListItemDto(
				$developerDto,
				count($buildObjectList),
				$buildObjectList
			);
		}, $developerList);

	}
}