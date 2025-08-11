<?php

namespace Craft\DDD\Developers\Infrastructure\Service\ImportHandler\Source;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Domain\Entity\DeveloperEntity;
use Craft\DDD\Developers\Domain\Repository\ApartmentRepositoryInterface;
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
use Craft\DDD\Developers\Infrastructure\Service\ImportHandler\ImportHandlerInterface;
use Craft\DDD\Shared\Application\Service\ImageServiceInterface;
use Craft\DDD\Shared\Domain\ValueObject\LatitudeValueObject;
use Craft\DDD\Shared\Domain\ValueObject\LongitudeValueObject;
use SimpleXMLElement;

class YandexImport implements ImportHandlerInterface
{
	public function __construct(
		protected BuildObjectRepositoryInterface $buildObjectRepository,
		protected ApartmentRepositoryInterface   $apartmentRepository,
		protected DeveloperEntity                $developer,
		protected ImageServiceInterface          $imageSaver,
	)
	{
	}

	public function execute(string $xmlData): void
	{
		$read = new SimpleXMLElement($xmlData);


		foreach($read->offer as $offer)
		{
			$rawApartmentData = json_decode(json_encode($offer), true);
			$offerAttributes = $offer->attributes();

			$externalId = (string)$offerAttributes['internal-id'];

			$listPlanImages = [];
			$listGalleryImages = [];

			foreach($offer->image as $image)
			{
				$imageAttributes = $image->attributes();
				if($imageAttributes['tag'] == 'plan')
				{
					$listPlanImages[] = (string)$image;
				} else
				{
					$listGalleryImages[] = (string)$image;
				}
			}

			$buildObjectGallery = array_map(function(string $url) {
				$savedImage = $this->imageSaver->storeFromUrl($url);
				return $savedImage->id;
			}, $listGalleryImages);
			$planImageList = array_map(function(string $url) {
				$savedImage = $this->imageSaver->storeFromUrl($url);
				return $savedImage->id;
			}, $listPlanImages);

			$buildObject = $this->buildObjectRepository->findByName($rawApartmentData['building-name']);
			if($buildObject)
			{
				$buildObject->updateFromImport(
					$rawApartmentData['building-name'],
					$rawApartmentData['building-type'],
					$rawApartmentData['floors-total'],
					new LocationValueObject(
						new CountryValueObject($rawApartmentData['location']['country'] ?? null),
						new RegionValueObject($rawApartmentData['location']['region'] ?? null),
						new DistrictValueObject($rawApartmentData['location']['district'] ?? null),
						new CityValueObject($rawApartmentData['location']['locality-name'] ?? null),
						new AddressValueObject($rawApartmentData['location']['address'] ?? null),
						new ApartmentValueObject($rawApartmentData['location']['apartment'] ?? null),
						new LongitudeValueObject($rawApartmentData['location']['longitude'] ?? null),
						new LatitudeValueObject($rawApartmentData['location']['latitude'] ?? null),
					),
					$this->developer,
					$buildObjectGallery,
					$this->developer->getCity()

				);

				$buildObject = $this->buildObjectRepository->update($buildObject);
			} else
			{
				$buildObject = BuildObjectEntity::createFromImport(
					$rawApartmentData['building-name'],
					$rawApartmentData['building-type'],
					$rawApartmentData['floors-total'],
					new LocationValueObject(
						new CountryValueObject($rawApartmentData['location']['country'] ?? null),
						new RegionValueObject($rawApartmentData['location']['region'] ?? null),
						new DistrictValueObject($rawApartmentData['location']['district'] ?? null),
						new CityValueObject($rawApartmentData['location']['locality-name'] ?? null),
						new AddressValueObject($rawApartmentData['location']['address'] ?? null),
						new ApartmentValueObject($rawApartmentData['location']['apartment'] ?? null),
						new LongitudeValueObject($rawApartmentData['location']['longitude'] ?? null),
						new LatitudeValueObject($rawApartmentData['location']['latitude'] ?? null),
					),
					$this->developer,
					$buildObjectGallery,
					$this->developer->getCity()
				);


				$buildObject = $this->buildObjectRepository->create($buildObject);
			}


			$existApartment = $this->apartmentRepository->findByExternalId($externalId);
			if($existApartment)
			{
				$existApartment->updateFromImport(
					$buildObject->getId(),
					$rawApartmentData['description'][0],
					$rawApartmentData['price']['value'],
					intval($rawApartmentData['rooms']),
					intval($rawApartmentData['floor']),
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
					$rawApartmentData['mortgage'],
					$rawApartmentData['built-year'],
					new BuiltStateValueObject($rawApartmentData['building-state']),
					$planImageList,
				);

				$this->apartmentRepository->update($existApartment);
			} else
			{
				$apartment = ApartmentEntity::createFromImport(
					$buildObject,
					$buildObject->getId(),
					$rawApartmentData['description'][0],
					$rawApartmentData['price']['value'],
					intval($rawApartmentData['rooms']),
					intval($rawApartmentData['floor']),
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
					$rawApartmentData['mortgage'],
					$rawApartmentData['built-year'],
					$planImageList,
					new BuiltStateValueObject($rawApartmentData['building-state']),
					$externalId,
				);


				$this->apartmentRepository->create($apartment);
			}

		}
	}

}