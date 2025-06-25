<?php

namespace Craft\Dto;

class BxImageDto
{
	public function __construct(
		public int    $id,
		public string $src,
	)
	{
	}
}