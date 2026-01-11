<?php

namespace Craft\DDD\Statistic\Application\Services;

use Craft\DDD\Statistic\Application\Dto\ClaimStatDto;
use Craft\DDD\Statistic\Domain\Entity\OrderEntity;
use Craft\DDD\Statistic\Domain\Repository\OrderRepositoryInterface;

class ClaimStatService
{

	public function __construct(
		private OrderRepositoryInterface $orderRepository,
	)
	{
	}

	public function execute(int $userId): ClaimStatDto
	{
		$orders = $this->obtainOrdersByUserId($userId);

		$claimTotal = $this->countOrderByUser($orders);
		$moneyRotate = $this->obtainMoneyRotate($orders);
		$acceptTake = $this->obtainAcceptTake($orders);


		return new ClaimStatDto(
			'4%',
			$claimTotal,
			$moneyRotate,
			$acceptTake,
		);
	}

	/**
	 * @param OrderEntity[] $orders
	 */
	private function obtainAcceptTake(array $orders): int
	{
		$result = 0;

		return $result;
	}

	private function obtainOrdersByUserId(int $userId): array
	{
		return $this->orderRepository->findAllByUserId($userId);
	}

	/**
	 * @param OrderEntity[] $orders
	 */
	private function obtainMoneyRotate(array $orders): int
	{
		return array_reduce($orders, function(int $count, OrderEntity $order) {

			$count += $order->getCost();

			return $count;
		}, 0);
	}

	/**
	 * @param OrderEntity[] $orders
	 */
	private function countOrderByUser(array $orders): int
	{
		return count($orders);
	}
}