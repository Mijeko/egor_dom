<?php

namespace Craft\DDD\Claims\Application\Dto;

final class UserOrderInfoDto
{
	public array $items = [];

	public static function instance(): UserOrderInfoDto
	{
		$self = new self();
		return $self;
	}

	public function addInfo(string $value): UserOrderInfoDto
	{
		$this->items[] = $value;
		return $this;
	}
}