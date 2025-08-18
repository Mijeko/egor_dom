<?php

namespace Craft\DDD\Claims\Application\UseCase;

use Craft\DDD\Claims\Application\Dto\UserOrderInfoDto;
use Craft\DDD\Claims\Domain\Repository\ClaimRepositoryInterface;
use Craft\Helper\CurrencyHtml;
use Craft\Helper\Money;

class ShortOrderInfoUseCase
{

	public function __construct(
		protected ClaimRepositoryInterface $claimRepository,
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

		$rotate = (function() {
			return rand();
		})();

		$income = (function() {
			return rand();
		})();

		return UserOrderInfoDto::instance()
			->addInfo('<span style="font-weight: 600; color:green;">Вознаграждение: 4%</span>')
			->addInfo('Кол-во сделок: ' . count($orders))
			->addInfo('Оборот: ' . Money::format($rotate) . CurrencyHtml::icon())
			->addInfo('Получено: ' . Money::format($income) . CurrencyHtml::icon());
	}
}