<?php

namespace Craft\DDD\Objects\Infrastructure\Dto;

use Craft\Dto\BxImage;


/**
 * @var BxImage[] $gallery
 */
class BuildObjectDetailDto
{
	public function __construct(
		public string   $id,
		public string   $name,
		public ?BxImage $image = null,
		public ?array   $gallery = null,
	)
	{
	}
}