<?php

namespace Craft\DDD\FavoriteProduct\Infrastructure\Repository;

use Craft\DDD\FavoriteProduct\Domain\Entity\FavoriteProduct;
use Craft\DDD\FavoriteProduct\Domain\Repository\FavoriteProductRepositoryInterface;
use Craft\DDD\FavoriteProduct\Domain\ValueObject\ProductIdValueObject;
use Craft\DDD\FavoriteProduct\Domain\ValueObject\UserIdValueObject;
use Craft\DDD\FavoriteProduct\Infrastructure\Entity\EO_FavoriteProduct;
use Craft\DDD\FavoriteProduct\Infrastructure\Entity\FavoriteProductTable;
use Craft\Helper\Criteria;

class FavoriteProductRepository implements FavoriteProductRepositoryInterface
{
	public function create(FavoriteProduct $favoriteProduct): ?FavoriteProduct
	{
		return null;
	}

	public function findByUserIdAndProductId(int $userId, int $productId): ?FavoriteProduct
	{
		$list = $this->findAll(
			Criteria::instance()->filter([
				FavoriteProductTable::F_PRODUCT_ID => $productId,
				FavoriteProductTable::F_USER_ID    => $userId,
			])
		);

		if(count($list) !== 1)
		{
			return null;
		}

		return array_shift($list);
	}

	public function findAll(Criteria $criteria): array
	{
		$results = [];
		$list = FavoriteProductTable::getList($criteria->build())->fetchCollection();

		foreach($list as $favoriteProduct)
		{
			$results[] = $this->hydrate($favoriteProduct);
		}

		return $results;
	}

	private function hydrate(EO_FavoriteProduct $model): FavoriteProduct
	{
		return FavoriteProduct::hydrate(
			new ProductIdValueObject($model->getProductId()),
			new UserIdValueObject($model->getUserId())
		);
	}
}