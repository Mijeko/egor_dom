<?php

namespace Craft\DDD\Statistic\Application\Services;

use Craft\DDD\Statistic\Domain\Entity\OrderEntity;
use Craft\DDD\Statistic\Domain\Repository\OrderRepositoryInterface;
use Craft\Helper\Criteria;

class ProfitService
{
	private float $companyProfit;

	public function __construct(
		private OrderRepositoryInterface $orderRepository,
	)
	{
		$this->companyProfit = 4.0;
	}

	public function companyProfitByAllOrders(): int
	{
		$orders = $this->orderRepository->findAll();
		if(!$orders)
		{
			return 0;
		}

		return array_reduce($orders, function(float $result, OrderEntity $order) {
			return $result + $this->companyProfit($order->getCost());
		}, 0);
	}

	public function companyProfitByOrders(array $orderIdList): int
	{
		$orders = $this->orderRepository->findAll(Criteria::instance()->filter([
			'ID' => $orderIdList,
		]));

		if(!$orders)
		{
			return 0;
		}

		return array_reduce($orders, function(float $result, OrderEntity $order) {
			return $result + $this->companyProfit($order->getCost());
		}, 0);
	}

	public function companyProfitByOrder(int $orderId): int
	{
		$order = $this->orderRepository->findById($orderId);
		if(!$order)
		{
			return 0;
		}

		return $this->companyProfit($order->getCost());
	}

	public function companyProfit(int $cost): float
	{
		return $cost - ($cost * ($this->companyProfit / 100));
	}
}