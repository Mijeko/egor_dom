<?php

namespace Craft\DDD\Claims\Application\UseCase;

use Craft\DDD\Claims\Application\Dto\ClaimFinishDto;
use Craft\DDD\Claims\Domain\Repository\ClaimRepositoryInterface;
use Craft\DDD\Claims\Domain\ValueObject\StatusValueObject;

class ClaimFinishUseCase
{

	public function __construct(
		protected ClaimRepositoryInterface $claimRepository
	)
	{
	}

	public function execute(ClaimFinishDto $claimUpdateDto): void
	{
		$claim = $this->claimRepository->findById($claimUpdateDto->id);
		if(!$claim)
		{
			throw new \Exception('Заявка не найдена');
		}


		$claim->finish(StatusValueObject::finishClaim());

		$this->claimRepository->update($claim);


	}
}