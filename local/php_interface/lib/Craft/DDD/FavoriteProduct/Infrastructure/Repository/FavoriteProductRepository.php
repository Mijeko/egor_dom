<?php

namespace Craft\DDD\FavoriteProduct\Infrastructure\Repository;

use Craft\DDD\FavoriteProduct\Domain\Entity\FavoriteProduct;
use Craft\DDD\FavoriteProduct\Domain\Repository\FavoriteProductRepositoryInterface;

class FavoriteProductRepository implements FavoriteProductRepositoryInterface
{
	public function create(FavoriteProduct $favoriteProduct): ?FavoriteProduct
	{
		return null;
	}
}