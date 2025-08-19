<?php

namespace Craft\DDD\FavoriteProduct\Domain\Repository;

use Craft\DDD\FavoriteProduct\Domain\Entity\FavoriteProduct;

interface FavoriteProductRepositoryInterface
{
	public function create(FavoriteProduct $favoriteProduct): ?FavoriteProduct;
}