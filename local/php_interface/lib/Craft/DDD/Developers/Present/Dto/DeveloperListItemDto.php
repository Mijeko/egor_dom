<?php

namespace Craft\DDD\Developers\Present\Dto;

use Craft\Dto\BxImageDto;

final class DeveloperListItemDto
{
	public function __construct(
		public int         $id,
		public string      $name,
		public ?BxImageDto $picture,
		public ?int        $buildObjectsCount,
		public ?string     $detailUrl,
		public ?array      $buildObjects = [],
	)
	{
	}
}