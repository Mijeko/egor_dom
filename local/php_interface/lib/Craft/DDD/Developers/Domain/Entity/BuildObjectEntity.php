<?php

namespace Craft\DDD\Developers\Domain\Entity;

use Craft\Dto\BxImageDto;

class BuildObjectEntity
{
	public function __construct(
		protected ?int             $id,
		protected string           $name,
		protected ?int             $developerId = null,
		protected ?int             $pictureId = null,
		protected ?DeveloperEntity $developer = null,
		protected ?BxImageDto      $picture = null,
		protected ?array           $apartments = null,
		protected ?array           $gallery = null,
	)
	{
	}

	public static function fromImport(
		string          $name,
		DeveloperEntity $developer,
	): static
	{
		return new static(null,
			$name,
			null,
			null,
			$developer
		);
	}

	public function refreshIdAfterCreate(int $id): static
	{
		$this->id = $id;
		return $this;
	}

	public function addDeveloper(DeveloperEntity $developer): static
	{
		$this->developer = $developer;
		return $this;
	}

	public function getDeveloper(): ?DeveloperEntity
	{
		return $this->developer;
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

	public function getPictureId(): ?int
	{
		return $this->pictureId;
	}

	public function getDeveloperId(): ?int
	{
		return $this->developerId;
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