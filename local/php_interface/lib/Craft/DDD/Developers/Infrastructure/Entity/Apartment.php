<?php

namespace Craft\DDD\Developers\Infrastructure\Entity;

use Craft\DDD\Shared\Domain\ValueObject\ImageGalleryValueObject;

class Apartment extends EO_Apartment
{
	public function setPlanImageEx(?ImageGalleryValueObject $galleryValueObject): static
	{
		$images = [];
		if($galleryValueObject)
		{
			$images = $galleryValueObject->getImageIdList();
		}

		$jsonData = json_encode($images);
		$this->setPlanImage($jsonData);
		return $this;
	}

	/**
	 * @return int[]
	 */
	public function getPlanImageEx(): array
	{
		$unJsonedData = json_decode($this->getPlanImage(), true);

		return $unJsonedData;
	}

	/**
	 * @return int[]
	 */
	public function getGalleryEx(): array
	{
		return [];
	}
}