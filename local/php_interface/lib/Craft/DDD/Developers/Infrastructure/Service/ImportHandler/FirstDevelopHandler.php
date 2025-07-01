<?php

namespace Craft\DDD\Developers\Infrastructure\Service\ImportHandler;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Developers\Application\ApartmentService;
use Craft\DDD\Developers\Application\Service\BuildObjectService;
use Craft\DDD\Developers\Application\Service\DeveloperService;
use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Domain\Entity\DeveloperEntity;
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
use Craft\DDD\Shared\Domain\ValueObject\ImageValueObject;
use Craft\DDD\Shared\Domain\ValueObject\LatitudeValueObject;
use Craft\DDD\Shared\Domain\ValueObject\LongitudeValueObject;
use Craft\Dto\BxImageDto;

class FirstDevelopHandler implements ImportHandlerInterface
{


	public function __construct(
		protected DeveloperService   $developerService,
		protected BuildObjectService $buildObjectService,
		protected ApartmentService   $apartmentService,
		protected DeveloperEntity    $developer,
	)
	{
	}


	public function execute(string $xmlData): void
	{
		$read = new \SimpleXMLElement($xmlData);

		foreach($read->complex as $rawApartmentData)
		{
			foreach($rawApartmentData->buildings as $building)
			{
				$building = $building->building;

				$buildObject = BuildObjectEntity::fromImport(
					(string)$building->name,
					is_string((string)$building->building_type) ? (string)$building->building_type : null,
					(int)$building->floors,
					$this->developer,
					ImageValueObject::fromUrl((string)$rawApartmentData->images->image)
				);


				foreach($building->flats as $flat)
				{
					$flat = $flat->flat;

					$buildObject->addApartment(
						new ApartmentEntity(
							null,
							null,
							(string)$flat->name,
							(string)$flat->description,
							(int)$flat->price,
							(int)$flat->rooms,
							(int)$flat->floor,
							new AreaValueObject(
								(float)$flat->area,
								'кв.м',
								new LivingSpaceValueObject(
									(float)$flat->living_area,
									'кв.м'
								),
								new KitchenSpaceValueObject(
									(float)$flat->kitchen_area,
									'кв.м'
								)
							),
							(string)$flat->renovation,
							null,
							null,
							(int)$building->floors,
							null,
							(int)$building->built_year,
							new BuiltStateValueObject(
								(string)$building->building_state
							),
							new LocationValueObject(
								null,
								null,
								null,
								null,
								null,
								null,
								new LongitudeValueObject(
									$rawApartmentData->longitude
								),
								new LatitudeValueObject(
									$rawApartmentData->latitude
								)
							),
						)
					);
				}


				$buildObject = $this->buildObjectService->create($buildObject);
			}


			//			$apartment = ApartmentEntity::fromImport(
			//				$buildObject,
			//				$rawApartmentData['description'][0],
			//				$rawApartmentData['price']['value'],
			//				$rawApartmentData['rooms'],
			//				$rawApartmentData['floor'],
			//				new AreaValueObject(
			//					$rawApartmentData['area']['value'],
			//					$rawApartmentData['area']['unit'],
			//					new LivingSpaceValueObject(
			//						$rawApartmentData['living-space']['value'],
			//						$rawApartmentData['living-space']['unit'],
			//					),
			//					new KitchenSpaceValueObject(
			//						$rawApartmentData['kitchen-space']['value'],
			//						$rawApartmentData['kitchen-space']['unit'],
			//					)
			//				),
			//				$rawApartmentData['renovation'],
			//				new StringLogicValueObject($rawApartmentData['parking']),
			//				new StringLogicValueObject($rawApartmentData['bathroom-unit']),
			//				$rawApartmentData['floors-total'],
			//				$rawApartmentData['mortgage'],
			//				$rawApartmentData['built-year'],
			//				new BuiltStateValueObject($rawApartmentData['building-state']),
			//				new LocationValueObject(
			//					new CountryValueObject($rawApartmentData['location']['country']),
			//					new RegionValueObject($rawApartmentData['location']['region']),
			//					new DistrictValueObject($rawApartmentData['location']['district']),
			//					new CityValueObject($rawApartmentData['location']['locality-name']),
			//					new AddressValueObject($rawApartmentData['location']['address']),
			//					new ApartmentValueObject($rawApartmentData['location']['apartment']),
			//					new LongitudeValueObject($rawApartmentData['location']['longitude']),
			//					new LatitudeValueObject($rawApartmentData['location']['latitude']),
			//				)
			//			);

			//			Debug::dumpToFile($apartment);

			//			$apartment = $this->apartmentService->create($apartment);
		}
	}
}