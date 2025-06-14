<?php

use Craft\DDD\Developers\Domain\Entity\Developer;
use Craft\DDD\Developers\Infrastructure\Dto\DeveloperFrontDto;
use Craft\DDD\Developers\Application\Service\DeveloperService;
use Craft\DDD\Developers\Infrastructure\Entity\DeveloperTable;
use Craft\DDD\Developers\Application\Service\DeveloperServiceFactory;

class CraftDevelopersComponent extends CBitrixComponent
{

	protected ?DeveloperService $service = null;

	public function onPrepareComponentParams($arParams)
	{
		$arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
		return $arParams;
	}

	public function executeComponent()
	{
		try
		{
			$this->loadServices();
			$this->loadData();
			$this->includeComponentTemplate();
		} catch(Exception $e)
		{

		}
	}

	protected function loadServices(): void
	{
		if($this->arParams['IBLOCK_ID'])
		{
			$this->service = DeveloperServiceFactory::createOnIblock($this->arParams['IBLOCK_ID']);
		} else
		{
			$this->service = DeveloperServiceFactory::createOnOrm();
		}
	}

	protected function loadData(): void
	{
		$this->arResult['DEVELOPERS'] = array_map(
			function(Developer $developer) {
				return DeveloperFrontDto::fromModel($developer);
			},
			$this->service->findAll([
				'filter' => [
					#DeveloperTable::F_ACTIVE => DeveloperTable::ACTIVE_Y,
				],
			])
		);
	}
}