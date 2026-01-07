<?php

namespace Craft\DDD\UserBehavior\Application\Factory;

use Craft\DDD\UserBehavior\Application\UseCase\AddProductInViewedUseCase;
use Craft\DDD\UserBehavior\Infrastructure\Repository\ProductViewedRepository;

class AddProductInViewedUseCaseFactory
{
	public static function getUseCase(): AddProductInViewedUseCase
	{
		return new AddProductInViewedUseCase(
			new ProductViewedRepository()
		);
	}
}