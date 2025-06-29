<?php

namespace Craft\DDD\Developers\Infrastructure\Service;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Developers\Domain\Repository\ApartmentRepositoryInterface;
use Craft\DDD\Developers\Domain\Repository\DeveloperRepositoryInterface;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Domain\Repository\BuildObjectRepositoryInterface;
use Craft\DDD\Developers\Domain\ValueObject\AddressValueObject;
use Craft\DDD\Developers\Domain\ValueObject\ApartmentValueObject;
use Craft\DDD\Developers\Domain\ValueObject\AreaValueObject;
use Craft\DDD\Developers\Domain\ValueObject\BuiltStateValueObject;
use Craft\DDD\Developers\Domain\ValueObject\CityValueObject;
use Craft\DDD\Developers\Domain\ValueObject\CountryValueObject;
use Craft\DDD\Developers\Domain\ValueObject\DistrictValueObject;
use Craft\DDD\Developers\Domain\ValueObject\KitchenSpaceValueObject;
use Craft\DDD\Developers\Domain\ValueObject\LivingSpaceValueObject;
use Craft\DDD\Developers\Domain\ValueObject\LocationValueObject;
use Craft\DDD\Developers\Domain\ValueObject\RegionValueObject;
use Craft\DDD\Developers\Domain\ValueObject\StringLogicValueObject;
use Craft\DDD\Shared\Domain\ValueObject\LatitudeValueObject;
use Craft\DDD\Shared\Domain\ValueObject\LongitudeValueObject;

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

			if(!$buildObject = $this->buildObjectRepository->findByName($rawApartmentData['building-name']))
			{
				$buildObject = BuildObjectEntity::fromImport(
					$rawApartmentData['building-name'],
					$developer
				);
				$this->buildObjectRepository->create($buildObject);
			}


			$apartment = ApartmentEntity::fromImport(
				$buildObject,
				$rawApartmentData['description'][0],
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
				new StringLogicValueObject($rawApartmentData['parking']),
				new StringLogicValueObject($rawApartmentData['bathroom-unit']),
				$rawApartmentData['floors-total'],
				$rawApartmentData['mortgage'],
				$rawApartmentData['built-year'],
				new BuiltStateValueObject($rawApartmentData['building-state']),
				new LocationValueObject(
					new CountryValueObject($rawApartmentData['location']['country']),
					new RegionValueObject($rawApartmentData['location']['region']),
					new DistrictValueObject($rawApartmentData['location']['district']),
					new CityValueObject($rawApartmentData['location']['locality-name']),
					new AddressValueObject($rawApartmentData['location']['address']),
					new ApartmentValueObject($rawApartmentData['location']['apartment']),
					new LongitudeValueObject($rawApartmentData['location']['longitude']),
					new LatitudeValueObject($rawApartmentData['location']['latitude']),
				)
			);

			Debug::dumpToFile($apartment);

			$apartment = $this->apartmentRepository->create($apartment);
		}
	}
}