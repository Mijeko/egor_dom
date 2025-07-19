<?php

namespace Craft\DDD\Developers\Application\Factory;

use Craft\DDD\Developers\Application\UseCase\ApartmentPreFilterUseCase;

class ApartmentPreFilterUseCaseFactory
{
	public static function getService(): ApartmentPreFilterUseCase
	{
		return new ApartmentPreFilterUseCase(
			ApartmentServiceFactory::createOnOrm()
		);
	}
}