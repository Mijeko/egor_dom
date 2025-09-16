<?php

namespace Craft\DDD\Claims\Application\UseCase;

use Craft\DDD\Claims\Application\Dto\UserOrderInfoDto;
use Craft\DDD\Claims\Domain\Entity\ClaimEntity;
use Craft\DDD\Claims\Domain\Repository\ClaimRepositoryInterface;
use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Developers\Domain\Repository\ApartmentRepositoryInterface;
use Craft\DDD\Developers\Infrastructure\Entity\ApartmentTable;
use Craft\Helper\Criteria;
use Craft\Helper\CurrencyHtml;
use Craft\Helper\Money;

class ShortOrderInfoUseCase
{

	public function __construct(
		protected ClaimRepositoryInterface     $claimRepository,
		protected ApartmentRepositoryInterface $apartmentRepository,
	)
	{
	}

	public function execute(int $userId): ?UserOrderInfoDto
	{
		if(!$userId)
		{
			return null;
		}

		$orders = $this->claimRepository->findAllByUserId($userId);
		$apartmentList = $this->apartmentRepository->findAll(Criteria::instance(
			[],
			[
				ApartmentTable::F_ID => array_map(function(ClaimEntity $claim) {
					return $claim->getId();
				}, $orders),
			]
		));

		$rotate = (function(array $apartmentList) {
			return array_reduce($apartmentList, function($init, ApartmentEntity $entity) {
				$init += $entity?->getPrice() ?? 0;

				return $init;
			}, 0);
		})($apartmentList);

		$income = (function(array $orders) {
			return array_reduce($orders, function($init, ClaimEntity $entity) {
				$init += $entity?->getApartmentEntity()?->getPrice() ?? 0;

				return $init;
			}, 0);
		})($orders);

		return UserOrderInfoDto::instance()
			->addInfo('<span style="font-weight: 600; color:green;">Вознаграждение: 4%</span>')
			->addInfo('Кол-во сделок: ' . count($orders))
			->addInfo('Оборот: ' . Money::format($rotate) . CurrencyHtml::icon())
			->addInfo('К получению: ' . Money::format($income) . CurrencyHtml::icon());
	}
}