<?php

namespace Craft\DDD\Notify\Application\Services;

use Craft\DDD\Claims\Application\Services\NotifyChannel\EmailNotifyService;
use Craft\DDD\Claims\Application\Services\NotifyChannel\TelegramNotifyService;
use Craft\DDD\Claims\Domain\Entity\ClaimEntity;
use Craft\DDD\Claims\Domain\Entity\ManagerEntity;
use Craft\DDD\Claims\Domain\Repository\ManagerRepositoryInterface;

class ManagerNotificatorService
{

	public function __construct(
		protected ManagerRepositoryInterface $managerRepository,
		protected TelegramNotifyService      $telegramNotifyService,
		protected EmailNotifyService         $emailNotifyService,
	)
	{
	}

	public function claimAcceptManager(ClaimEntity $claim)
	{

	}

	public function aboutNewClaim(ClaimEntity $claimEntity): void
	{
		$managers = $this->managerRepository->findAll();

		$tgNotifyMembers = array_filter($managers, function(ManagerEntity $managerEntity) {
			return $managerEntity?->getAvailChannelContact()?->getChannelTg()?->getTgId();
		});

		$emailNotifyMembers = array_filter($managers, function(ManagerEntity $managerEntity) {
			return $managerEntity->getAvailChannelContact()?->getChannelEmail()?->getEmail();
		});



		$this->telegramNotifyService->aboutNewClaim($tgNotifyMembers, $claimEntity);
		$this->emailNotifyService->aboutNewClaim($emailNotifyMembers, $claimEntity);

	}
}