<?php

namespace Craft\DDD\Claims\Application\UseCase;

use Craft\DDD\Claims\Application\Dto\ClaimCreateDto;
use Craft\DDD\Claims\Application\Interfaces\TgSenderInterface;
use Craft\DDD\Claims\Domain\Entity\ClaimEntity;
use Craft\DDD\Claims\Domain\Repository\BuyerRepositoryInterface;
use Craft\DDD\Claims\Domain\Repository\ClaimRepositoryInterface;
use Craft\DDD\Claims\Domain\Repository\ManagerRepositoryInterface;
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
		protected BuyerRepositoryInterface     $buyerRepository,
		protected ManagerRepositoryInterface   $managerRepository,
	)
	{
	}

	public function execute(ClaimCreateDto $request): ClaimEntity
	{
		$apartment = $this->apartmentRepository->findById($request->apartmentId);
		if(!$apartment)
		{
			throw new \Exception("Квартира не найдена.");
		}

		$buyerEntity = $this->buyerRepository->findById($request->userId);
		if(!$buyerEntity)
		{
			throw new \Exception('Покупатель не найден.');
		}

		$manager = $this->managerRepository->findById($buyerEntity->getManagerId()->getValue());
		if(!$manager)
		{
			throw new \Exception('У вас не назначен менеджер.');
		}

		$claim = ClaimEntity::createClaim(
			StatusValueObject::newClaim(),
			new EmailValueObject($request->email),
			new PhoneValueObject($request->phone),
			$request->client,
			$apartment,
			$buyerEntity,
			$manager
		);

		return $this->claimRepository->create($claim);
	}
}