<?php

namespace Craft\DDD\FavoriteProduct\Infrastructure\Repository;

use Craft\DDD\FavoriteProduct\Domain\Entity\FavoriteProduct;
use Craft\DDD\FavoriteProduct\Domain\Repository\FavoriteProductRepositoryInterface;
use Craft\Helper\Criteria;

class FavoriteProductRepository implements FavoriteProductRepositoryInterface
{
	public function create(FavoriteProduct $favoriteProduct): ?FavoriteProduct
	{
		return null;
	}

	public function findByUserIdAndProductId(int $userId, int $productId): ?FavoriteProduct
	{
		return null;
	}

	public function findAll(Criteria $criteria): array
	{
		return [];
	}
}