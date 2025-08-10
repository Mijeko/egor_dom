<?php

namespace Craft\DDD\Developers\Infrastructure\Entity;

use Craft\DDD\Developers\Domain\ValueObject\LocationValueObject;

class BuildObject extends EO_BuildObject
{
	public function setGalleryEx(array $galleryData): void
	{
		foreach($galleryData as $fileId)
		{
			if(!is_numeric($fileId) || !is_int($fileId))
			{
				throw new \Exception('Неверный тип данных для картинок');
			}
		}

		$this->setGallery(json_encode($galleryData));
	}


	/**
	 * @return int[]
	 */
	public function getGalleryEx(): array
	{
		$result = [];

		try
		{
			if($this->getGallery())
			{
				$result = json_decode($this->getGallery(), true);
			}
		} catch(\Exception $e)
		{
		}

		if(!is_array($result))
		{
			$result = [];
		}

		return $result;
	}

	public function setLocationEx(?LocationValueObject $locationData): static
	{

		if(!$locationData)
		{
			return $this;
		}

		$this->setLocation(json_encode([
			'latitude'  => $locationData->getLatitude()->getValue(),
			'longitude' => $locationData->getLongitude()->getValue(),
			'country'   => $locationData->getCountry()->getValue(),
			'region'    => $locationData->getRegion()->getValue(),
			'district'  => $locationData->getDistrict()->getValue(),
			'city'      => $locationData->getLocalityName()->getValue(),
			'address'   => $locationData->getAddress()->getValue(),
			'apartment' => $locationData->getApartment()->getValue(),
		]));

		return $this;
	}

	public function getLocationEx(): array
	{
		$locationJson = json_decode($this->getLocation(), true);

		return $locationJson;
	}

}