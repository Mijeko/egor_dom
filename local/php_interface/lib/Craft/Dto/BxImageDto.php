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

	public static function empty(): BxImageDto
	{
		return new self(
			0,
			'https://images.cdn-cian.ru/images/82/588/141/rezhisser-krasnodar-jk-1418852805-7.jpg'
		);
	}
}