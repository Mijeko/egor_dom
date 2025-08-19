<?php

namespace Craft\DDD\FavoriteProduct\Application\UseCase;

use Craft\DDD\FavoriteProduct\Domain\Entity\FavoriteProduct;
use Craft\DDD\FavoriteProduct\Domain\Repository\FavoriteProductRepositoryInterface;
use Craft\DDD\FavoriteProduct\Domain\ValueObject\ProductIdValueObject;
use Craft\DDD\FavoriteProduct\Domain\ValueObject\UserIdValueObject;

class AddProductInFavoriteUseCase
{

	public function __construct(
		protected FavoriteProductRepositoryInterface $favoriteProductRepository
	)
	{
	}

	public function execute(int $productId, int $userId): void
	{

		if($this->favoriteProductRepository->findByUserIdAndProductId($userId, $productId))
		{
			return;
		}

		$favoriteItem = FavoriteProduct::create(
			new ProductIdValueObject($productId),
			new UserIdValueObject($userId)
		);

		$this->favoriteProductRepository->create($favoriteItem);

	}
}