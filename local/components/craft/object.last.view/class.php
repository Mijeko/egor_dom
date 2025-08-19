<?php

use Craft\DDD\Developers\Domain\Repository\BuildObjectRepositoryInterface;
use Craft\DDD\Developers\Infrastructure\Entity\BuildObjectTable;
use Craft\DDD\Developers\Infrastructure\Repository\OrmBuildObjectRepository;
use Craft\DDD\Developers\Present\Dto\BuildObjectDto;
use Craft\DDD\UserBehavior\Domain\Entity\ProductViewedEntity;
use Craft\DDD\UserBehavior\Domain\Repository\ProductViewedRepositoryInterface;
use Craft\DDD\UserBehavior\Infrastructure\Repository\ProductViewedRepository;
use Craft\Helper\Criteria;

class CraftObjectLastViewComponent extends CBitrixComponent
{

	protected ProductViewedRepositoryInterface $productViewedRepository;
	protected BuildObjectRepositoryInterface $buildObjectRepository;

	public function onPrepareComponentParams($arParams)
	{
		return $arParams;
	}

	public function executeComponent()
	{

		try
		{
			$this->loadService();
			$this->loadData();

			$this->includeComponentTemplate();
		} catch(Exception $e)
		{
		}
	}

	private function loadService(): void
	{
		$this->productViewedRepository = new ProductViewedRepository();
		$this->buildObjectRepository = new OrmBuildObjectRepository();
	}

	private function loadData(): void
	{
		$viewedItems = $this->productViewedRepository->findAllByUserId($this->arParams['USER_ID']);

		$buildObjectEntities = $this->buildObjectRepository->findAll(
			Criteria::instance()->filter([
				BuildObjectTable::F_ID => array_map(function(ProductViewedEntity $item) {
					return $item->getProductId()->getValue();
				}, $viewedItems),
			])
		);

		$this->arResult['BUILD_OBJECT_LIST'] = array_map(function(\Craft\DDD\Developers\Domain\Entity\BuildObjectEntity $buildObjectEntity) {
			return new BuildObjectDto(
				$buildObjectEntity->getId(),
				$buildObjectEntity->getName(),
				detailLink: '/objects/' . $buildObjectEntity->getId() . '/'
			);
		}, $buildObjectEntities);

	}
}