<?php

namespace Craft\DDD\Developers\Infrastructure\Service\ImportHandler\Source;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Developers\Application\Service\ApartmentService;
use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Domain\Entity\DeveloperEntity;
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

class YandexImport implements ImportHandlerInterface
{
	public function __construct(
		protected ApartmentService      $apartmentService,
		protected DeveloperEntity       $developer,
		protected ImageServiceInterface $imageSaver,
	)
	{
	}

	public function execute(string $xmlData): void
	{
		$read = new \SimpleXMLElement($xmlData);


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

			$existApartment = $this->apartmentService->findByExternalId($externalId);
			if($existApartment)
			{
				$buildObjectGallery = array_map(function(string $url) {
					$savedImage = $this->imageSaver->fromUrl($url);
					return $savedImage->id;
				}, $listGalleryImages);

				$buildObject = BuildObjectEntity::fromImport(
					$rawApartmentData['building-name'],
					$rawApartmentData['building-type'],
					$rawApartmentData['floors-total'],
					new LocationValueObject(
						new CountryValueObject($rawApartmentData['location']['country']),
						new RegionValueObject($rawApartmentData['location']['region']),
						new DistrictValueObject($rawApartmentData['location']['district']),
						new CityValueObject($rawApartmentData['location']['locality-name']),
						new AddressValueObject($rawApartmentData['location']['address']),
						new ApartmentValueObject($rawApartmentData['location']['apartment']),
						new LongitudeValueObject($rawApartmentData['location']['longitude']),
						new LatitudeValueObject($rawApartmentData['location']['latitude']),
					),
					$this->developer,
					$buildObjectGallery,
					$this->developer->getCity()

				);


				$planImageList = array_map(function(string $url) {
					$savedImage = $this->imageSaver->fromUrl($url);
					return $savedImage->id;
				}, $listPlanImages);

				$existApartment->updateFromImport(
					$buildObject,
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
					[],
				);


				$this->apartmentService->update($existApartment);
			} else
			{

				$buildObjectGallery = array_map(function(string $url) {
					$savedImage = $this->imageSaver->fromUrl($url);
					return $savedImage->id;
				}, $listGalleryImages);

				$planImageList = array_map(function(string $url) {
					$savedImage = $this->imageSaver->fromUrl($url);
					return $savedImage->id;
				}, $listPlanImages);

				$newBuildObject = BuildObjectEntity::fromImport(
					$rawApartmentData['building-name'],
					$rawApartmentData['building-type'],
					$rawApartmentData['floors-total'],
					new LocationValueObject(
						new CountryValueObject($rawApartmentData['location']['country']),
						new RegionValueObject($rawApartmentData['location']['region']),
						new DistrictValueObject($rawApartmentData['location']['district']),
						new CityValueObject($rawApartmentData['location']['locality-name']),
						new AddressValueObject($rawApartmentData['location']['address']),
						new ApartmentValueObject($rawApartmentData['location']['apartment']),
						new LongitudeValueObject($rawApartmentData['location']['longitude']),
						new LatitudeValueObject($rawApartmentData['location']['latitude']),
					),
					$this->developer,
					$buildObjectGallery,
					$this->developer->getCity()

				);

				$apartment = ApartmentEntity::createFromImport(
					$newBuildObject,
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
					[],
					new BuiltStateValueObject($rawApartmentData['building-state']),
					$externalId,
				);


				$apartment = $this->apartmentService->create($apartment);
			}

		}
	}

}