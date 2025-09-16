<?php

namespace Craft\DDD\Claims\Application\UseCase;

use Craft\DDD\Claims\Application\Dto\ClaimCreateDto;
use Craft\DDD\Claims\Application\Interfaces\TgSenderInterface;
use Craft\DDD\Claims\Domain\Entity\ClaimEntity;
use Craft\DDD\Claims\Domain\Repository\ClaimRepositoryInterface;
use Craft\DDD\Claims\Domain\ValueObject\StatusValueObject;
use Craft\DDD\Developers\Domain\Repository\ApartmentRepositoryInterface;
use Craft\DDD\Shared\Domain\ValueObject\EmailValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;
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

	public function execute(ClaimCreateDto $request): ClaimEntity
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
			StatusValueObject::newClaim(),
			new EmailValueObject($request->email),
			new PhoneValueObject($request->phone),
			$request->client,
			$apartment,
			$user
		);

		return $this->claimRepository->create($claim);
	}
}