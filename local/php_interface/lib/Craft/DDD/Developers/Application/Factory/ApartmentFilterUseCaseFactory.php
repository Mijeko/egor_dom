<?php

namespace Craft\DDD\Developers\Application\Factory;

use Craft\DDD\Developers\Application\UseCase\ApartmentFilterUseCase;

class ApartmentFilterUseCaseFactory
{
	public static function getService(): ApartmentFilterUseCase
	{
		return new ApartmentFilterUseCase(
			ApartmentServiceFactory::createOnOrm()
		);
	}
}