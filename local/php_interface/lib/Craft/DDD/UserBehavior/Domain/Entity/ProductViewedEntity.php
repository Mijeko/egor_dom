<?php

namespace Craft\DDD\UserBehavior\Domain\Entity;

use Craft\DDD\UserBehavior\Domain\ValueObject\ProductIdValueObject;
use Craft\DDD\UserBehavior\Domain\ValueObject\UserIdValueObject;

class ProductViewedEntity
{
	private ProductIdValueObject $productId;
	private UserIdValueObject $userId;

	public static function hydrate(
		ProductIdValueObject $productId,
		UserIdValueObject    $userId
	): ProductViewedEntity
	{
		$self = new self();
		$self->productId = $productId;
		$self->userId = $userId;
		return $self;
	}

	public static function create(ProductIdValueObject $productId, UserIdValueObject $userId): ProductViewedEntity
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