<?php

namespace Craft\DDD\Objects\Domain\Entity;

use Craft\DDD\Apartment\Domain\Entity\ApartmentEntity;
use Craft\Dto\BxImage;

class BuildObject
{
	public function __construct(
		public int      $id,
		public string   $name,
		public ?BxImage $picture = null,
		public ?array   $apartments = null,
		public ?array   $gallery = null,
	)
	{
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getPicture(): ?BxImage
	{
		return $this->picture;
	}


	/**
	 * @return ApartmentEntity[] | null
	 */
	public function getApartments(): ?array
	{
		return $this->apartments;
	}

	/**
	 * @return BxImage[]|null
	 */
	public function getGallery(): ?array
	{
		return $this->gallery;
	}

}