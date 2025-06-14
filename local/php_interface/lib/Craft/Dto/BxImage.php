<?php

namespace Craft\Dto;

class BxImage
{
	public function __construct(
		public int    $id,
		public string $src,
	)
	{
	}
}