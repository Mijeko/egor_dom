<?php

namespace Craft\DDD\Developers\Infrastructure\Entity;

use Craft\DDD\Developers\Domain\ValueObject\LocationValueObject;

class BuildObject extends EO_BuildObject
{

	const UPLOAD_PATH = '/craft/develop/objects/';

	public function setGalleryEx(array $galleryData): void
	{
		$listFileId = [];

		foreach($galleryData as $fileData)
		{
			if(empty($fileData['ID']))
			{
				$file = \CIBlock::makeFileArray($fileData);
				$fileId = \CFile::SaveFile($file, self::UPLOAD_PATH);
			} else
			{
				$fileId = $fileData['ID'];
			}


			if($fileId)
			{
				$listFileId[] = $fileId;
			}
		}

		$this->setGallery(json_encode($listFileId));
	}

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
			'latitude'  => $locationData->getLatitude(),
			'longitude' => $locationData->getLongitude(),
			'country'   => $locationData->getCountry(),
			'region'    => $locationData->getRegion(),
			'district'  => $locationData->getDistrict(),
			'city'      => $locationData->getLocalityName(),
			'address'   => $locationData->getAddress(),
			'apartment' => $locationData->getApartment(),
		]));

		return $this;
	}

}