<?php

namespace Craft\DDD\FavoriteProduct\Domain\Repository;

use Craft\DDD\FavoriteProduct\Domain\Entity\FavoriteProduct;
use Craft\Helper\Criteria;

interface FavoriteProductRepositoryInterface
{
	public function findByUserIdAndProductId(int $userId, int $productId): ?FavoriteProduct;

	public function findAll(Criteria $criteria): array;

	public function create(FavoriteProduct $favoriteProduct): ?FavoriteProduct;
}