<?php

namespace Craft\DDD\FavoriteProduct\Domain\Entity;

use Craft\DDD\FavoriteProduct\Domain\ValueObject\ProductIdValueObject;
use Craft\DDD\FavoriteProduct\Domain\ValueObject\UserIdValueObject;

class FavoriteProduct
{
	private ProductIdValueObject $productId;
	private UserIdValueObject $userId;

	public static function hydrate(
		ProductIdValueObject $productId,
		UserIdValueObject    $userId
	): FavoriteProduct
	{
		$self = new self();
		$self->productId = $productId;
		$self->userId = $userId;
		return $self;
	}

	public static function create(ProductIdValueObject $productId, UserIdValueObject $userId): FavoriteProduct
	{
		$self = new self();
		$self->productId = $productId;
		$self->userId = $userId;
		return $self;
	}

	public function getUserId(): UserIdValueObject
	{
		return $this->userId;
	}

	public function getProductId(): ProductIdValueObject
	{
		return $this->productId;
	}
}