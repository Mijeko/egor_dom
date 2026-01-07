<?php

namespace Craft\DDD\UserBehavior\Application\Dto;


/**
 * @property ViewedItemDto[] $viewItems
 */
class ViewedInformationDto
{
	/** @param ViewedItemDto[] $items */
	public function __construct(
		public array $items
	)
	{
	}
}