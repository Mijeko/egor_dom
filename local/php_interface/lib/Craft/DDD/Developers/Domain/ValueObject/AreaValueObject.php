<?php

namespace Craft\DDD\Developers\Domain\ValueObject;

class AreaValueObject
{
	public function __construct(
		protected int                     $totalValue,
		protected string                  $unit,

		protected LivingSpaceValueObject  $livingSpace,
		protected KitchenSpaceValueObject $kitchenSpace,
	)
	{
	}

	public function getTotalValue(): int
	{
		return $this->totalValue;
	}

	public function getUnit(): string
	{
		return $this->unit;
	}

	public function getLivingSpace(): LivingSpaceValueObject
	{
		return $this->livingSpace;
	}

	public function getKitchenSpace(): KitchenSpaceValueObject
	{
		return $this->kitchenSpace;
	}
}