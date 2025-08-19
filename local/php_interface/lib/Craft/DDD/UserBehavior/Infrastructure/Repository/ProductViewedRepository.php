<?php

namespace Craft\DDD\UserBehavior\Infrastructure\Repository;

use Craft\DDD\UserBehavior\Domain\Entity\ProductViewedEntity;
use Craft\DDD\UserBehavior\Domain\Repository\ProductViewedRepositoryInterface;
use Craft\DDD\UserBehavior\Domain\ValueObject\ProductIdValueObject;
use Craft\DDD\UserBehavior\Domain\ValueObject\UserIdValueObject;
use Craft\DDD\UserBehavior\Infrastructure\Entity\EO_FavoriteProduct;
use Craft\DDD\UserBehavior\Infrastructure\Entity\FavoriteProductTable;
use Craft\Helper\Criteria;

class ProductViewedRepository implements ProductViewedRepositoryInterface
{
	public function create(ProductViewedEntity $favoriteProduct): ?ProductViewedEntity
	{
		$model = FavoriteProductTable::createObject();
		$model->setProductId($favoriteProduct->getProductId()->getValue());
		$model->setUserId($favoriteProduct->getUserId()->getValue());

		$result = $model->save();

		if(!$result->isSuccess())
		{
			return null;
		}

		return $favoriteProduct;
	}

	public function findByUserIdAndProductId(int $userId, int $productId): ?ProductViewedEntity
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
		$list = FavoriteProductTable::getList($criteria->makeGetListParams())->fetchCollection();

		foreach($list as $favoriteProduct)
		{
			$results[] = $this->hydrate($favoriteProduct);
		}

		return $results;
	}

	private function hydrate(EO_FavoriteProduct $model): ProductViewedEntity
	{
		return ProductViewedEntity::hydrate(
			new ProductIdValueObject($model->getProductId()),
			new UserIdValueObject($model->getUserId())
		);
	}

	public function findAllByUserId(int $userId): array
	{
		return $this->findAll(Criteria::instance()->filter([
			FavoriteProductTable::F_USER_ID => $userId,
		]));
	}
}