<?php

namespace Craft\DDD\Developers\Infrastructure\Service;

use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Developers\Domain\Repository\ApartmentRepositoryInterface;
use Craft\DDD\Developers\Domain\Repository\DeveloperRepositoryInterface;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Domain\Repository\BuildObjectRepositoryInterface;
use Craft\DDD\Developers\Domain\ValueObject\AreaValueObject;
use Craft\DDD\Developers\Domain\ValueObject\KitchenSpaceValueObject;
use Craft\DDD\Developers\Domain\ValueObject\LivingSpaceValueObject;

class ImportService
{

	public function __construct(
		protected DeveloperRepositoryInterface   $developerRepository,
		protected BuildObjectRepositoryInterface $buildObjectRepository,
		protected ApartmentRepositoryInterface   $apartmentRepository,
	)
	{
	}

	public function execute(int $developerId, string $xmlBuildData): void
	{
		$developer = $this->developerRepository->findById($developerId);
		if(!$developer)
		{
			throw new \Exception('Застройщик не найден');
		}

		$read = new \SimpleXMLElement($xmlBuildData);
		foreach($read->offer as $rawApartmentData)
		{
			$rawApartmentData = json_decode(json_encode($rawApartmentData), true);

			if($buildObject = $this->buildObjectRepository->findByName($rawApartmentData['building-name']))
			{
				$buildObject = BuildObjectEntity::fromImport($rawApartmentData['building-name']);
			}


			$apartment = ApartmentEntity::fromImport(
				$buildObject,
				'',
				$rawApartmentData['price']['value'],
				$rawApartmentData['rooms'],
				$rawApartmentData['floor'],
				new AreaValueObject(
					$rawApartmentData['area']['value'],
					$rawApartmentData['area']['unit'],
					new LivingSpaceValueObject(
						$rawApartmentData['living-space']['value'],
						$rawApartmentData['living-space']['unit'],
					),
					new KitchenSpaceValueObject(
						$rawApartmentData['kitchen-space']['value'],
						$rawApartmentData['kitchen-space']['unit'],
					)
				),
				$rawApartmentData['renovation'],
			);

			$apartment = $this->apartmentRepository->create($apartment);
		}
	}
}