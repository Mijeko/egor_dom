<?php

namespace Craft\DDD\UserBehavior\Application\Dto;

class ViewedItemDto
{
	public function __construct(
		public int    $productId,
		public int    $userId,
		public string $name,
		public string $detailLink,
	)
	{
	}
}