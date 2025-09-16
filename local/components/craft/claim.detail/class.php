<?php

use Craft\DDD\Claims\Application\Services\ClaimService;
use Craft\DDD\Claims\Application\Factory\ClaimServiceFactory;
use Craft\DDD\Claims\Present\Dto\ClaimDetailDto;
use Craft\DDD\Claims\Present\Dto\ClaimDto;
use Craft\DDD\Claims\Present\Dto\StatusClaimDto;
use Craft\DDD\Developers\Domain\Repository\ApartmentRepositoryInterface;
use Craft\DDD\Developers\Domain\Repository\BuildObjectRepositoryInterface;
use Craft\DDD\Developers\Infrastructure\Repository\OrmApartmentRepository;
use Craft\DDD\Developers\Infrastructure\Repository\OrmBuildObjectRepository;
use Craft\DDD\Developers\Present\Dto\ApartmentDto;
use Craft\DDD\Developers\Present\Dto\BuildObjectDto;
use Craft\DDD\Shared\Application\Service\ImageServiceInterface;
use Craft\DDD\Shared\Infrastructure\Service\ImageService;
use Craft\Dto\BxImageDto;

class CraftClaimDetailComponent extends CBitrixComponent
{

	protected ClaimService $claimRepository;
	protected ApartmentRepositoryInterface $apartmentRepository;
	protected BuildObjectRepositoryInterface $buildObjectRepository;
	protected ImageServiceInterface $imageService;

	public function onPrepareComponentParams($arParams)
	{
		$arParams['ID'] = intval($arParams['ID']);

		return $arParams;
	}

	public function executeComponent()
	{
		try
		{

			$this->loadServices();
			$this->loadData();
			$this->meta();

			$this->includeComponentTemplate();
		} catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}

	protected function loadServices(): void
	{
		$this->claimRepository = ClaimServiceFactory::getClaimService();
		$this->apartmentRepository = new OrmApartmentRepository();
		$this->buildObjectRepository = new OrmBuildObjectRepository();
		$this->imageService = new ImageService();
	}

	protected function loadData(): void
	{
		$claim = $this->claimRepository->findById($this->arParams['ID']);
		$apartment = $this->apartmentRepository->findById($claim->getApartmentId());
		$buildObject = $this->buildObjectRepository->findById($apartment->getBuildObjectId());

		$this->arResult['CLAIM'] = new ClaimDetailDto(
			new ClaimDto(
				$claim->getId(),
				new StatusClaimDto(
					$claim->getStatus()->getCode(),
					$claim->getStatus()->getLabel(),
					$claim->getStatus()->getIcon(),
					$claim->getStatus()->getColor(),
				),
				$claim->getName(),
				$claim->getClient(),
				$claim->getPhone(),
				$claim->getEmail(),
				new ApartmentDto(
					$apartment->getId(),
					$apartment->getBuildObjectId(),
					$apartment->getName(),
					$apartment->getPrice(),
					$apartment->getRooms(),
					$apartment->getFloor(),
					$apartment->getBuiltYear(),
					$apartment->getBuildingState()->getLabel(),
					new BuildObjectDto(
						$buildObject->getId(),
						$buildObject->getName(),
						$buildObject->getType(),
						$buildObject->getFloors(),
						null,
					),
					array_map(function(int $imageId) {
						$_img = $this->imageService->findById($imageId);
						return new BxImageDto(
							$_img->id,
							$_img->src,
						);
					}, $apartment->getPlanImagesIdList()),
				),
			),

		);
	}

	protected function meta(): void
	{
		global $APPLICATION;

		/* @var ClaimDetailDto $claim */
		$claim = $this->arResult['CLAIM'];

		$APPLICATION->SetTitle('Заявка на приобретение ' . $claim->claim->apartment->name);
	}
}