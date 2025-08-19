<?php

namespace Craft\DDD\FavoriteProduct\Domain\Entity;

use Craft\DDD\FavoriteProduct\Domain\ValueObject\ProductIdValueObject;
use Craft\DDD\FavoriteProduct\Domain\ValueObject\UserIdValueObject;

class FavoriteProduct
{
	private ProductIdValueObject $productId;
	private UserIdValueObject $userId;

	public function getUserId(): UserIdValueObject
	{
		return $this->userId;
	}

	public function getProductId(): ProductIdValueObject
	{
		return $this->productId;
	}
}