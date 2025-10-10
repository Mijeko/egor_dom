<?php

namespace Craft\DDD\Developers\Application\Factory;

use Craft\DDD\Developers\Application\UseCase\FeedUpdateUseCase;

class FeedUpdateUseCaseFactory
{
	public static function getUseCase(): FeedUpdateUseCase
	{
		return new FeedUpdateUseCase();
	}
}