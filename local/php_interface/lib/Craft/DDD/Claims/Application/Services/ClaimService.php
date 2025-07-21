<?php

namespace Craft\DDD\Claims\Application\Services;

use Craft\DDD\Claims\Application\Dto\ClaimCreateDto;
use Craft\DDD\Claims\Application\UseCase\ClaimCreateUseCase;
use Craft\DDD\Claims\Domain\Entity\ClaimEntity;
use Craft\DDD\Claims\Domain\Repository\ClaimRepositoryInterface;
use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Domain\Repository\ApartmentRepositoryInterface;
use Craft\DDD\Developers\Domain\Repository\BuildObjectRepositoryInterface;
use Craft\DDD\Developers\Infrastructure\Entity\ApartmentTable;
use Craft\DDD\Developers\Infrastructure\Entity\BuildObjectTable;
use Craft\DDD\Shared\Infrastructure\Exceptions\NotFoundOrmElement;
use Craft\DDD\User\Domain\Repository\UserRepositoryInterface;

class ClaimService
{

	public function __construct(
		protected ClaimRepositoryInterface       $repository,
		protected ApartmentRepositoryInterface   $apartmentRepository,
		protected UserRepositoryInterface        $userRepository,
		protected BuildObjectRepositoryInterface $buildObjectRepository,
		protected ClaimCreateUseCase             $claimCreateUseCase,
		protected ManagerNotificatorService      $managerNotificatorService,
	)
	{
	}

	public function createClientClaim(ClaimCreateDto $s): ClaimEntity
	{
		$claim = $this->claimCreateUseCase->execute($s);
		$this->managerNotificatorService->aboutNewClaim($claim);

		return $claim;
	}


	/**
	 * @return ClaimEntity[]
	 */
	public function findAllClaim(): array
	{
		$claims = $this->repository->findAll();
		$this->loadRelations($claims);
		return $claims;
	}

	/**
	 * @return ClaimEntity[]
	 */
	public function findAllByUserId(int $userId, array $order = []): array
	{
		$claims = $this->repository->findAllByUserId($userId, $order);
		if(!$claims)
		{
			throw new NotFoundOrmElement('Заявки не найдены');
		}


		$this->loadRelations($claims);

		return $claims;
	}

	public function findById(int $id): ?ClaimEntity
	{
		$claim = $this->repository->findById($id);

		if(!$claim)
		{
			throw new NotFoundOrmElement('Заявка не найдена');
		}

		$_claims = [$claim];

		$this->loadRelations($_claims);

		return array_shift($_claims);

	}

	public function create(ClaimEntity $claim): ?ClaimEntity
	{
		return $this->repository->create($claim);
	}

	private function loadRelations(array &$claims): void
	{
		$apartmentIdList = array_map(function(ClaimEntity $claim) {
			return $claim->getApartmentId();
		}, $claims);

		$apartments = $this->apartmentRepository->findAll(
			[],
			[
				ApartmentTable::F_ID => $apartmentIdList,
			]
		);

		if($apartments)
		{

			$buildObjectIdList = array_map(function(ApartmentEntity $apartment) {
				return $apartment->getBuildObjectId();
			}, $apartments);

			$buildObjects = $this->buildObjectRepository->findAll(
				[],
				[
					BuildObjectTable::F_ID => $buildObjectIdList,
				]
			);


			if($buildObjects)
			{
				$apartments = array_map(function(ApartmentEntity $apartmentEntity) use ($buildObjects) {

					$buildObject = array_filter($buildObjects, function(BuildObjectEntity $buildObject) use ($apartmentEntity) {
						return $apartmentEntity->getBuildObjectId() === $buildObject->getId();
					});

					if(count($buildObject) == 1)
					{
						$buildObject = array_shift($buildObject);
						$apartmentEntity->addBuildObject($buildObject);
					}

					return $apartmentEntity;

				}, $apartments);
			}


			$claims = array_map(function(ClaimEntity $claim) use ($apartments) {

				$currentApartment = array_filter($apartments, function(ApartmentEntity $apartment) use ($claim) {
					return $claim->getApartmentId() === $apartment->getId();
				});

				if(count($currentApartment) == 1)
				{
					$currentApartment = array_shift($currentApartment);
					$claim->addApartment($currentApartment);
				}

				return $claim;

			}, $claims);
		}
	}
}
