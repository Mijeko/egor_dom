<?php

namespace Craft\DDD\Developers\Infrastructure\Service;

use Bitrix\Main\Application;
use Craft\DDD\Developers\Application\Dto\ApartmentFilterDto;

class ApartmentFilterBuilder
{
	public static function fromUrl(): ApartmentFilterDto
	{
		$request = Application::getInstance()->getContext()->getRequest();

		return new ApartmentFilterDto(
			$request['filter']['developerId'],
			$request['filter']['buildObjectId'],
			$request['filter']['minPrice'],
			$request['filter']['maxPrice'],
			$request['filter']['bathroom'],
			$request['filter']['renovation'],
			$request['filter']['floorsTotal'],
			$request['filter']['roomsTotal'],
			$request['filter']['floor'],
		);
	}
}