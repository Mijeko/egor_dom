<?php

namespace Craft\DDD\Developers\Infrastructure\Entity;

use Craft\DDD\Objects\Infrastructure\Entity\EO_BuildObject;

class BuildObject extends EO_BuildObject
{

	const UPLOAD_PATH = '/craft/develop/objects/';

	public function setGalleryEx(array $galleryData): void
	{
		$files = [];

		foreach($galleryData as $fileData)
		{
			$file = \CIBlock::makeFileArray($fileData);
			$fileId = \CFile::SaveFile($file, self::UPLOAD_PATH);
			if($fileId)
			{
				$files[] = $fileId;
			}
		}

		$this->setGallery(json_encode($files));
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

}