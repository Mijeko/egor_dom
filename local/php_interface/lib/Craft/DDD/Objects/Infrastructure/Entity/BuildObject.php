<?php

namespace Craft\DDD\Objects\Infrastructure\Entity;

class BuildObject extends EO_BuildObject
{

	public function setFiles($values): void
	{

		$entity = BuildObjectTable::getEntity();

		foreach($values as $propertyCode => $value)
		{
		}

	}

	public function setGalleryEx()
	{

	}

	public function getGalleryEx(): array
	{
		$result = [];

		return $result;
	}

}