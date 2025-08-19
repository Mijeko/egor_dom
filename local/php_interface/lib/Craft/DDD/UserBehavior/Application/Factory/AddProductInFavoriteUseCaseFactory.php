<?php

namespace Craft\DDD\UserBehavior\Application\Factory;

use Craft\DDD\UserBehavior\Application\UseCase\AddProductInFavoriteUseCase;
use Craft\DDD\UserBehavior\Infrastructure\Repository\ProductViewedRepository;

class AddProductInFavoriteUseCaseFactory
{
	public static function getUseCase(): AddProductInFavoriteUseCase
	{
		return new AddProductInFavoriteUseCase(
			new ProductViewedRepository()
		);
	}
}