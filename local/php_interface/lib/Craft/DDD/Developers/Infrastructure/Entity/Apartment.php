<?php

namespace Craft\DDD\Developers\Infrastructure\Entity;

use Craft\DDD\Developers\Domain\ValueObject\AreaValueObject;
use Craft\DDD\Shared\Domain\ValueObject\ImageGalleryValueObject;

class Apartment extends EO_Apartment
{

	const string MAIN_AREA = 'main';
	const string KITCHEN_AREA = 'kitchenArea';
	const string LIVING_AREA = 'livingArea';

	const string TOTAL_VALUE_KEY = 'totalValue';
	const string UNIT_KEY = 'UNIT';

	public function setAreaEx(AreaValueObject $areaValueObject): static
	{

		$jsonAreaData = json_encode([
			self::MAIN_AREA    => [
				self::TOTAL_VALUE_KEY => $areaValueObject->getTotalValue(),
				self::UNIT_KEY        => $areaValueObject->getUnit(),
			],
			self::KITCHEN_AREA => [
				self::TOTAL_VALUE_KEY => $areaValueObject->getKitchenSpace()->getValue(),
				self::UNIT_KEY        => $areaValueObject->getKitchenSpace()->getValue(),
			],
			self::LIVING_AREA  => [
				self::TOTAL_VALUE_KEY => $areaValueObject->getLivingSpace()->getValue(),
				self::UNIT_KEY        => $areaValueObject->getLivingSpace()->getUnit(),
			],
		]);

		$this->setArea($jsonAreaData);

		return $this;
	}

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


	public function getPlanImageEx(): array
	{
		$unJsonedData = json_decode($this->getPlanImage(), true);

		return $unJsonedData;
	}

	public function getGalleryEx(): array
	{
		return [];
	}
}