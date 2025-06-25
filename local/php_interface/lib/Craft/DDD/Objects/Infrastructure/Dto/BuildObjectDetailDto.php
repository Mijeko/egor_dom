<?php

namespace Craft\DDD\Objects\Infrastructure\Dto;

use Craft\Dto\BxImageDto;


/**
 * @var BxImageDto[] $gallery
 */
class BuildObjectDetailDto
{
	public function __construct(
		public string      $id,
		public string      $name,
		public ?BxImageDto $image = null,
		public ?array      $gallery = null,
		public ?array      $apartments = null,
	)
	{
	}
}