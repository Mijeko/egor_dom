<?php

namespace Craft\DDD\Developers\Domain\Entity;

use Craft\DDD\Developers\Domain\Entity\ApartmentEntity;
use Craft\Dto\BxImageDto;

class BuildObjectEntity
{
	public function __construct(
		public ?int        $id,
		public string      $name,
		public ?BxImageDto $picture = null,
		public ?array      $apartments = null,
		public ?array      $gallery = null,
	)
	{
	}

	public static function fromImport(string $name): static
	{
		return new static(null, $name);
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
	 * @return \Craft\DDD\Developers\Domain\Entity\ApartmentEntity[] | null
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