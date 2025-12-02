<?php

namespace Craft\Dto;

class MenuItemDto
{

	public function __construct(
		public ?string $title,
		public ?string $url,
	)
	{
	}

}