<?php

namespace Craft\DDD\UserBehavior\Application\UseCase;

use Craft\DDD\UserBehavior\Application\Dto\ViewedInformationDto;
use Craft\DDD\UserBehavior\Application\Dto\ViewedItemDto;
use Craft\DDD\UserBehavior\Domain\Entity\ProductViewedEntity;
use Craft\DDD\UserBehavior\Domain\Repository\ProductViewedRepositoryInterface;

class ObtainViewedInformationUseCase
{
	public function __construct(
		private ProductViewedRepositoryInterface $productViewedRepository
	)
	{
	}

	public function execute(int $userId): ViewedInformationDto
	{
		$elements = $this->productViewedRepository->findAllByUserId($userId);

		return new ViewedInformationDto(array_map(fn(ProductViewedEntity $el) => new ViewedItemDto(
			$el->getProductId()->getValue(),
			$el->getUserId()->getValue(),
			$el->getName()->getValue(),
			$el->getDetailLink()->getValue(),
		), $elements));
	}
}