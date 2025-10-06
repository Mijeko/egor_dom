<?php

namespace Craft\DDD\Statistic\Domain\Entity;

class OrderEntity
{

	private int $id;
	private int $cost;

	public static function hydrate(
		int $id,
		int $cost
	): OrderEntity
	{
		$self = new self();
		$self->id = $id;
		$self->cost = $cost;
		return $self;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getCost(): int
	{
		return $this->cost;
	}

}