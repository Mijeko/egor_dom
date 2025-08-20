<?php

use Craft\Core\Component\AjaxComponent;
use Craft\DDD\Referal\Application\Dto\JoinClientToClientDto;
use Craft\DDD\Referal\Application\Factory\InviteClientUseCaseFactory;
use Craft\DDD\Referal\Application\UseCase\InviteClientUseCase;
use Craft\DDD\Referal\Domain\Repository\ReferralRepositoryInterface;
use Craft\DDD\Referal\Infrastructure\Repository\ReferralRepository;

class CraftReferralJoinComponent extends AjaxComponent
{
	protected ReferralRepositoryInterface $referralRepository;
	protected InviteClientUseCase $joinClientToClientUseCase;

	function componentNamespace(): string
	{
		return 'craftReferralJoin';
	}

	protected function validate(array $postData): void
	{
	}

	protected function work(array $formData): void
	{

		try
		{
			$this->joinClientToClientUseCase->execute(
				new JoinClientToClientDto(
					$formData['inviteUserId'],
					$formData['phone'],
					$formData['code'],
				)
			);
		} catch(Exception $exception)
		{
		}
	}

	protected function modules(): ?array
	{
		return null;
	}

	protected function loadData(): void
	{
	}

	public function loadServices(): void
	{
		$this->referralRepository = new ReferralRepository();
		$this->joinClientToClientUseCase = InviteClientUseCaseFactory::getUseCase();
	}
}