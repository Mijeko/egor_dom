<?php

namespace Craft\DDD\Developers\Infrastructure\Service\ImportHandler;

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
use Craft\DDD\Shared\Application\Service\ImageServiceInterface;
use Craft\DDD\Shared\Domain\ValueObject\ImageGalleryValueObject;
use Craft\DDD\Shared\Domain\ValueObject\ImageValueObject;
use Craft\DDD\Shared\Domain\ValueObject\LatitudeValueObject;
use Craft\DDD\Shared\Domain\ValueObject\LongitudeValueObject;

class FirstDevelopHandler implements ImportHandlerInterface
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
				$existApartment->updateFromImport(
					BuildObjectEntity::fromImport(
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
						new ImageGalleryValueObject(
							array_map(function(string $imageUrl) {

								$image = $this->imageSaver->fromUrl($imageUrl);
								if(!$image)
								{
									return null;
								}

								return new ImageValueObject(
									$image->id,
									$image->src,
								);
							}, $listGalleryImages)
						),
						$this->developer->getCity()

					),
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
					new ImageGalleryValueObject(
						array_map(function(string $imageUrl) {

							$image = $this->imageSaver->fromUrl($imageUrl);
							if(!$image)
							{
								return null;
							}

							return new ImageValueObject(
								$image->id,
								$image->src,
							);
						}, $listGalleryImages)
					),
				);


				$this->apartmentService->update($existApartment);
			} else
			{
				$apartment = ApartmentEntity::createFromImport(
					BuildObjectEntity::fromImport(
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
						new ImageGalleryValueObject(
							array_map(function(string $imageUrl) {

								$image = $this->imageSaver->fromUrl($imageUrl);
								if(!$image)
								{
									return null;
								}

								return new ImageValueObject(
									$image->id,
									$image->src,
								);
							}, $listGalleryImages)
						),
						$this->developer->getCity()

					),
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
					$externalId,
					new ImageGalleryValueObject(
						array_map(function(string $imageUrl) {

							$image = $this->imageSaver->fromUrl($imageUrl);
							if(!$image)
							{
								return null;
							}

							return new ImageValueObject(
								$image->id,
								$image->src,
							);
						}, $listGalleryImages)
					),
				);
				$apartment = $this->apartmentService->create($apartment);
			}

		}
	}
}