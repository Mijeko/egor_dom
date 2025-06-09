<?php

use Craft\DDD\Developers\Application\Service\DeveloperService;
use Craft\DDD\Developers\Infrastructure\Entity\DeveloperTable;
use Craft\DDD\Developers\Application\Service\DeveloperServiceFactory;

class CraftDevelopersComponent extends CBitrixComponent
{

	protected ?DeveloperService $service = null;

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
		} catch(Exception $e)
		{

		}
	}

	protected function loadServices(): void
	{
		$this->service = DeveloperServiceFactory::create();
	}

	protected function loadData(): void
	{
		$this->arResult['DEVELOPERS'] = $this->service->findAll([
			'filter' => [
//				DeveloperTable::F_ACTIVE => DeveloperTable::ACTIVE_Y,
			],
		]);
	}
}