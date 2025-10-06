<?php

namespace Craft\DDD\Statistic\Application\Services;

use Craft\DDD\Statistic\Domain\Repository\OrderRepositoryInterface;

class ProfitService
{
	private float $companyProfit;

	public function __construct(
		private OrderRepositoryInterface $orderRepository,
	)
	{
		$this->companyProfit = 4.0;
	}

	public function companyProfitByOrder(int $orderId): int
	{
		$order = $this->orderRepository->findById($orderId);
		if(!$order)
		{
			throw new \Exception("Заказ #{$orderId} не найден");
		}

		return $this->companyProfit($order->getCost());
	}

	public function companyProfit(int $cost): float
	{
		return $cost - ($cost * ($this->companyProfit / 100));
	}
}