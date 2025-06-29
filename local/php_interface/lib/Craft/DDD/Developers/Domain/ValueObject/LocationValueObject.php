<?php

namespace Craft\DDD\Developers\Domain\ValueObject;

use Craft\DDD\Shared\Domain\ValueObject\LatitudeValueObject;
use Craft\DDD\Shared\Domain\ValueObject\LongitudeValueObject;

class LocationValueObject
{
	public function __construct(
		protected ?CountryValueObject   $country,
		protected ?RegionValueObject    $region,
		protected ?DistrictValueObject  $district,
		protected ?CityValueObject      $localityName,
		protected ?AddressValueObject   $address,
		protected ?ApartmentValueObject $apartment,
		protected ?LongitudeValueObject $longitude,
		protected ?LatitudeValueObject  $latitude,
	)
	{
	}


	public function getAddress(): ?AddressValueObject
	{
		return $this->address;
	}

	public function getApartment(): ?ApartmentValueObject
	{
		return $this->apartment;
	}

	public function getCountry(): ?CountryValueObject
	{
		return $this->country;
	}

	public function getDistrict(): ?DistrictValueObject
	{
		return $this->district;
	}

	public function getLatitude(): ?LatitudeValueObject
	{
		return $this->latitude;
	}

	public function getLocalityName(): ?CityValueObject
	{
		return $this->localityName;
	}

	public function getLongitude(): ?LongitudeValueObject
	{
		return $this->longitude;
	}

	public function getRegion(): ?RegionValueObject
	{
		return $this->region;
	}

}