<?php

namespace Craft\DDD\Developers\Present\Dto;


/**
 * @property array<int, BuildObjectDto> $buildObjects
 */
final class DeveloperListItemDto
{
	public function __construct(
		public DeveloperDto $developer,
		public ?int         $buildObjectsCount,
		public ?array       $buildObjects = [],
	)
	{
	}
}