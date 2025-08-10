<?php

namespace Craft\DDD\Developers\Domain\ValueObject;

class AreaValueObject
{
	const string MAIN_AREA = 'main';
	const string KITCHEN_AREA = 'kitchenArea';
	const string LIVING_AREA = 'livingArea';

	const string TOTAL_VALUE_KEY = 'totalValue';
	const string UNIT_KEY = 'UNIT';


	public function __construct(
		protected int                      $totalValue,
		protected string                   $unit,

		protected ?LivingSpaceValueObject  $livingSpace,
		protected ?KitchenSpaceValueObject $kitchenSpace,
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

	public function getLivingSpace(): ?LivingSpaceValueObject
	{
		return $this->livingSpace;
	}

	public function getKitchenSpace(): ?KitchenSpaceValueObject
	{
		return $this->kitchenSpace;
	}

	public function toJson(): string
	{
		return json_encode([
			self::MAIN_AREA    => [
				self::TOTAL_VALUE_KEY => $this->getTotalValue(),
				self::UNIT_KEY        => $this->getUnit(),
			],
			self::KITCHEN_AREA => [
				self::TOTAL_VALUE_KEY => $this->getKitchenSpace()->getValue(),
				self::UNIT_KEY        => $this->getKitchenSpace()->getValue(),
			],
			self::LIVING_AREA  => [
				self::TOTAL_VALUE_KEY => $this->getLivingSpace()->getValue(),
				self::UNIT_KEY        => $this->getLivingSpace()->getUnit(),
			],
		]);
	}
}