<?php

namespace Craft\DDD\UserBehavior\Application\Dto;

class AddProductInViewedDto
{
	public function __construct(
		public int    $productId,
		public int    $userId,
		public string $name,
		public string $link,
	)
	{
	}
}