<?php

namespace Craft\DDD\Developers\Infrastructure\Entity;

class Apartment extends EO_Apartment
{
	public function setPlanImageEx(array $imageIdList): static
	{

		foreach($imageIdList as $imageId)
		{
			if(!is_numeric($imageId) || !is_int($imageId))
			{
				throw new \Exception('Неверный тип данных для картинки');
			}
		}

		$this->setPlanImage(json_encode($imageIdList));
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