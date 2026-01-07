<?php

namespace Craft\DDD\UserBehavior\Application\UseCase;

use Craft\DDD\UserBehavior\Application\Dto\AddProductInViewedDto;
use Craft\DDD\UserBehavior\Domain\Entity\ProductViewedEntity;
use Craft\DDD\UserBehavior\Domain\Repository\ProductViewedRepositoryInterface;
use Craft\DDD\UserBehavior\Domain\ValueObject\DetailLinkValueObject;
use Craft\DDD\UserBehavior\Domain\ValueObject\NameValueObject;
use Craft\DDD\UserBehavior\Domain\ValueObject\ProductIdValueObject;
use Craft\DDD\UserBehavior\Domain\ValueObject\UserIdValueObject;

class AddProductInViewedUseCase
{

	public function __construct(
		protected ProductViewedRepositoryInterface $favoriteProductRepository
	)
	{
	}

	public function execute(AddProductInViewedDto $dto): void
	{
		if($this->favoriteProductRepository->findByUserIdAndProductId($dto->userId, $dto->productId))
		{
			return;
		}

		$favoriteItem = ProductViewedEntity::create(
			new ProductIdValueObject($dto->productId),
			new UserIdValueObject($dto->userId),
			new NameValueObject($dto->name),
			new DetailLinkValueObject($dto->link),
		);

		$this->favoriteProductRepository->create($favoriteItem);

	}
}