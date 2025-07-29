<?php

namespace Craft\DDD\Shared\Presentation\Dto;

use Craft\DDD\Developers\Domain\ValueObject\LocationValueObject;

final class LocationDto
{
	public function __construct(
		public ?string $country,
		public ?string $region,
		public ?string $district,
		public ?string $localityName,
		public ?string $address,
		public ?string $apartment,
		public ?string $longitude,
		public ?string $latitude,
	)
	{
	}


	public static function fromModel(LocationValueObject $locationValueObject): LocationDto
	{
		return new LocationDto(
			$locationValueObject->getCountry()->getValue(),
			$locationValueObject->getRegion()->getValue(),
			$locationValueObject->getDistrict()->getValue(),
			$locationValueObject->getLocalityName()->getValue(),
			$locationValueObject->getAddress()->getValue(),
			$locationValueObject->getApartment()->getValue(),
			$locationValueObject->getLongitude()->getValue(),
			$locationValueObject->getLatitude()->getValue(),
		);
	}
}