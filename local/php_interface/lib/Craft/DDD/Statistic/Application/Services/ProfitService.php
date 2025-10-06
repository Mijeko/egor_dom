<?php

namespace Craft\DDD\Statistic\Application\Services;

use Craft\DDD\Statistic\Domain\Entity\OrderEntity;
use Craft\DDD\Statistic\Domain\Repository\OrderRepositoryInterface;

class ProfitService
{
	private float $baseProfitValue;
	private float $managerProfitValue;

	public function __construct(
		private OrderRepositoryInterface $orderRepository,
	)
	{
		$this->baseProfitValue = 4.0;
		$this->managerProfitValue = 70;
	}

	public function companyProfitByAllOrders(): float
	{
		return $this->baseProfitByAllOrders() - $this->managerProfitByAllOrders();
	}

	public function managerProfitByAllOrders(): int
	{
		$baseProfit = $this->baseProfitByAllOrders();

		return $this->calcManagerProfit($baseProfit);
	}

	public function baseProfitByAllOrders(): int
	{
		$orders = $this->orderRepository->findAll();
		if(!$orders)
		{
			return 0;
		}

		return array_reduce($orders, function(float $result, OrderEntity $order) {
			return $result + $this->calcBaseProfit($order->getCost());
		}, 0);
	}

	public function calcBaseProfit(int $cost): float
	{
		return ($cost * ($this->baseProfitValue / 100));
	}

	public function calcManagerProfit(int $cost): int
	{
		return ($cost * ($this->managerProfitValue / 100));
	}
}