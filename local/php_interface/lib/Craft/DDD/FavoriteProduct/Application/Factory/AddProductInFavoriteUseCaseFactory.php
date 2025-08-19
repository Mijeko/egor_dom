<?php

namespace Craft\DDD\FavoriteProduct\Application\Factory;

use Craft\DDD\FavoriteProduct\Application\UseCase\AddProductInFavoriteUseCase;
use Craft\DDD\FavoriteProduct\Infrastructure\Repository\FavoriteProductRepository;

class AddProductInFavoriteUseCaseFactory
{
	public static function getUseCase(): AddProductInFavoriteUseCase
	{
		return new AddProductInFavoriteUseCase(
			new FavoriteProductRepository()
		);
	}
}