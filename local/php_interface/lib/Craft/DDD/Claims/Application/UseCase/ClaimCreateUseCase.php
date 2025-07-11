<?php

namespace Craft\DDD\Claims\Application\UseCase;

use Craft\DDD\Claims\Application\Dto\ClaimCreateDto;
use Craft\DDD\Claims\Application\Interfaces\TgNotifyInterface;
use Craft\DDD\Claims\Domain\Entity\ClaimEntity;
use Craft\DDD\Claims\Domain\Repository\ClaimRepositoryInterface;
use Craft\DDD\Developers\Domain\Repository\ApartmentRepositoryInterface;
use Craft\DDD\User\Domain\Repository\UserRepositoryInterface;

class ClaimCreateUseCase
{

	public function __construct(
		protected ApartmentRepositoryInterface $apartmentRepository,
		protected ClaimRepositoryInterface     $claimRepository,
		protected UserRepositoryInterface      $userRepository,
	)
	{
	}

	public function execute(ClaimCreateDto $request): ?ClaimEntity
	{
		$apartment = $this->apartmentRepository->findById($request->apartmentId);
		if(!$apartment)
		{
			throw new \Exception("Квартира не найдена");
		}

		$user = $this->userRepository->findById($request->userId);
		if(!$user)
		{
			throw new \Exception('Пользователь не найден');
		}

		$claim = ClaimEntity::createClaim(
			$request->email,
			$request->phone,
			$request->client,
			$request->inn,
			$request->kpp,
			$request->bik,
			$request->ogrn,
			$request->currAccount,
			$request->corrAccount,
			$request->legalAddress,
			$request->postAddress,
			$request->bankName,
			$apartment,
			$user
		);

		$claim = $this->claimRepository->create($claim);

		return $claim;
	}
}