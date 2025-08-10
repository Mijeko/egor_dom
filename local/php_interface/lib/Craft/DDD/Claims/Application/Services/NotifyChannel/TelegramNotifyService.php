<?php

namespace Craft\DDD\Claims\Application\Services\NotifyChannel;

use Bitrix\Main\Application;
use Craft\DDD\Claims\Application\Interfaces\TgSenderInterface;
use Craft\DDD\Claims\Domain\Entity\ClaimEntity;
use Craft\DDD\Claims\Domain\Entity\ManagerEntity;

class TelegramNotifyService
{
	public function __construct(
		protected TgSenderInterface $tgNotifyService,
	)
	{
	}


	/**
	 * @param ManagerEntity[] $members
	 * @param ClaimEntity $claimEntity
	 */
	public function aboutNewClaim(array $members, ClaimEntity $claimEntity): void
	{
		$message = "На сайте %s новый заказ №%s\n
		Клиент: %s (%s)\n\n
		Рег данные:\n
		ИНН: %s\n
		ОГРН: %s\n
		";
		$message = sprintf($message,
			Application::getInstance()->getContext()->getServer()->getServerName(),
			$claimEntity->getId(),
			$claimEntity->getClient(),
			$claimEntity->getPhone(),
			$claimEntity->getInn()->getValue(),
			$claimEntity->getOgrn()->getValue(),
		);

		foreach($members as $member)
		{
			$this->tgNotifyService->send(
				$member->getAvailChannelContact()->getChannelTg()->getTgId(),
				$message
			);
		}
	}
}