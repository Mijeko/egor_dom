<?php

namespace Craft\DDD\Shared\Domain\ValueObject;

use Bitrix\Main\Diag\Debug;

class ImageGalleryValueObject
{
	public function __construct(
		protected ?array $images,
	)
	{
		foreach($this->images as $image)
		{
			if(!is_null($image) && !$image instanceof ImageValueObject)
			{
				throw new \Exception('Объект картинки не соответствующего объекта');
			}
		}
	}

	/**
	 * @return ImageValueObject[]|null
	 */
	public function getImages(): ?array
	{
		return $this->images;
	}


	public static function fillFromId(array $imageIdList): static
	{
		$images = array_map(function(int $imageId) {
			$_image = \CFile::GetFileArray($imageId);

			if($_image)
			{
				return new ImageValueObject(
					$_image['ID'],
					$_image['SRC'],
				);
			}

			return null;

		}, $imageIdList);

		return new static($images);
	}
}