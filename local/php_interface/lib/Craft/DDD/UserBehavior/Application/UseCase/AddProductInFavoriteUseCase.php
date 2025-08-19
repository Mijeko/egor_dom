<?php

namespace Craft\DDD\UserBehavior\Application\UseCase;

use Craft\DDD\UserBehavior\Domain\Entity\ProductViewedEntity;
use Craft\DDD\UserBehavior\Domain\Repository\ProductViewedRepositoryInterface;
use Craft\DDD\UserBehavior\Domain\ValueObject\ProductIdValueObject;
use Craft\DDD\UserBehavior\Domain\ValueObject\UserIdValueObject;

class AddProductInFavoriteUseCase
{

	public function __construct(
		protected ProductViewedRepositoryInterface $favoriteProductRepository
	)
	{
	}

	public function execute(int $productId, int $userId): void
	{

		if($this->favoriteProductRepository->findByUserIdAndProductId($userId, $productId))
		{
			return;
		}

		$favoriteItem = ProductViewedEntity::create(
			new ProductIdValueObject($productId),
			new UserIdValueObject($userId)
		);

		$this->favoriteProductRepository->create($favoriteItem);

	}
}