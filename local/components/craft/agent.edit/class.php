<?php

use Craft\Core\Component\AjaxComponent;
use Craft\DDD\Claims\Domain\Entity\ClaimEntity;
use Craft\DDD\Claims\Domain\Repository\ClaimRepositoryInterface;
use Craft\DDD\Claims\Infrastructure\Entity\Claim;
use Craft\DDD\Claims\Present\Dto\ClaimDto;
use Craft\DDD\Claims\Present\Dto\StatusClaimDto;
use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Developers\Domain\Repository\ApartmentRepositoryInterface;
use Craft\DDD\Developers\Infrastructure\Entity\ApartmentTable;
use Craft\DDD\User\Domain\Repository\AgentRepositoryInterface;
use Craft\Helper\Criteria;

class CraftAgentEditComponent extends AjaxComponent
{
	protected ?AgentRepositoryInterface $agentRepository;
	protected ?ClaimRepositoryInterface $claimRepository;
	protected ?ApartmentRepositoryInterface $apartmentRepository;

	function componentNamespace(): string
	{
		return 'craftAgentDetail';
	}

	protected function validate(array $postData): void
	{
	}

	protected function work(array $formData): void
	{
	}

	protected function modules(): ?array
	{
		return [];
	}

	protected function loadData(): void
	{
		$agent = $this->agentRepository->findById($this->arParams['ID']);
		if(!$agent)
		{
			throw new Exception("Доступ запрещен");
		}

		$claims = $this->claimRepository->findAllByUserId($agent->getId());
		$apartments = $this->apartmentRepository->findAll(Criteria::instance(
			[],
			[
				ApartmentTable::F_ID => array_map(function(ClaimEntity $claimEntity) {
					return $claimEntity->getApartmentId();
				}, $claims),
			]
		));

		$this->arResult['ORDERS'] = array_map(function(ClaimEntity $claim) use ($apartments) {

			$currentApartment = null;
			$_currentApartment = array_filter($apartments, function(ApartmentEntity $apartment) use ($claim) {
				return $apartment->getId() == $claim->getApartmentId();
			});

			if(count($_currentApartment) == 1)
			{
				$currentApartment = array_shift($_currentApartment);
			}

			return new ClaimDto(
				$claim->getId(),
				StatusClaimDto::fromVO($claim->getStatus()),
				$claim->getName(),
				$claim->getClient(),
				$claim->getPhone()->getValue(),
				$claim->getEmail()->getValue(),
				$currentApartment,
				$claim->getCreatedAt(),
			);

		}, $claims);
	}

	public function loadServices(): void
	{
	}
}