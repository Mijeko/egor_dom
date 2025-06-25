<?php

namespace Craft\DDD\Objects\Domain\Entity;

use Craft\DDD\Apartment\Domain\Entity\ApartmentEntity;
use Craft\Dto\BxImageDto;

class BuildObject
{
	public function __construct(
		public int         $id,
		public string      $name,
		public ?BxImageDto $picture = null,
		public ?array      $apartments = null,
		public ?array      $gallery = null,
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

	public function getPicture(): ?BxImageDto
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
	 * @return BxImageDto[]|null
	 */
	public function getGallery(): ?array
	{
		return $this->gallery;
	}

}