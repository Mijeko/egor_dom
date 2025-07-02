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
}