<?php

namespace Craft\DDD\UserBehavior\Domain\Repository;

use Craft\DDD\UserBehavior\Domain\Entity\ProductViewedEntity;
use Craft\Helper\Criteria;

interface ProductViewedRepositoryInterface
{
	public function findByUserIdAndProductId(int $userId, int $productId): ?ProductViewedEntity;

	public function findAll(Criteria $criteria): array;

	public function findAllByUserId(int $userId): array;

	public function create(ProductViewedEntity $favoriteProduct): ?ProductViewedEntity;
}