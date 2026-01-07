<?php

namespace Craft\DDD\UserBehavior\Infrastructure\Repository;

use Bitrix\Main\Type\DateTime;
use Craft\DDD\Shared\Domain\ValueObject\DateTimeValueObject;
use Craft\DDD\UserBehavior\Domain\Entity\ProductViewedEntity;
use Craft\DDD\UserBehavior\Domain\Repository\ProductViewedRepositoryInterface;
use Craft\DDD\UserBehavior\Domain\ValueObject\DetailLinkValueObject;
use Craft\DDD\UserBehavior\Domain\ValueObject\NameValueObject;
use Craft\DDD\UserBehavior\Domain\ValueObject\ProductIdValueObject;
use Craft\DDD\UserBehavior\Domain\ValueObject\UserIdValueObject;
use Craft\DDD\UserBehavior\Infrastructure\Entity\EO_FavoriteProduct;
use Craft\DDD\UserBehavior\Infrastructure\Entity\EO_ViewedProduct;
use Craft\DDD\UserBehavior\Infrastructure\Entity\ViewedProductTable;
use Craft\Helper\Criteria;

class ProductViewedRepository implements ProductViewedRepositoryInterface
{
	public function create(ProductViewedEntity $favoriteProduct): ?ProductViewedEntity
	{
		$model = ViewedProductTable::createObject();

		$model->setProductId($favoriteProduct->getProductId()->getValue());
		$model->setUserId($favoriteProduct->getUserId()->getValue());
		$model->setLink($favoriteProduct->getDetailLink()->getValue());
		$model->setName($favoriteProduct->getName()->getValue());
		$model->setCreatedAt(new DateTime($favoriteProduct->getCreatedAt()));

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
				ViewedProductTable::F_PRODUCT_ID => $productId,
				ViewedProductTable::F_USER_ID    => $userId,
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
		$listQuery = ViewedProductTable::getList($criteria->makeGetListParams());

		$list = $listQuery->fetchCollection();

		foreach($list as $favoriteProduct)
		{
			$results[] = $this->hydrate($favoriteProduct);
		}

		return $results;
	}

	private function hydrate(EO_ViewedProduct $model): ProductViewedEntity
	{
		return ProductViewedEntity::hydrate(
			new ProductIdValueObject($model->getProductId()),
			new UserIdValueObject($model->getUserId()),
			new NameValueObject($model->getName()),
			new DetailLinkValueObject($model->getLink()),
			DateTimeValueObject::fromTimestamp($model->getCreatedAt()->getTimestamp()),
		);
	}

	public function findAllByUserId(int $userId): array
	{
		return $this->findAll(Criteria::instance()
			->order([
				ViewedProductTable::F_CREATED_AT => 'ASC',
			])
			->filter([
				ViewedProductTable::F_USER_ID => $userId,
			])
			->limit(5)
		);
	}
}