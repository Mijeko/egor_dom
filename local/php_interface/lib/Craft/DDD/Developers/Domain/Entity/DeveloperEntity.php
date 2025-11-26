<?php

namespace Craft\DDD\Developers\Domain\Entity;

use Craft\DDD\City\Domain\Entity\CityEntity;
use Craft\DDD\Developers\Domain\ValueObject\Developer\DescriptionValueObject;
use Craft\DDD\Developers\Domain\ValueObject\DeveloperSettingsValueObject;
use Craft\DDD\Developers\Domain\ValueObject\ImportSettingValueObject;
use Craft\DDD\Shared\Domain\ValueObject\ActiveValueObject;
use Craft\DDD\Shared\Domain\ValueObject\ImageValueObject;

/**
 *
 * @property BuildObjectEntity[] $buildObjects
 */
final class DeveloperEntity
{
	protected ?int $id;
	private ?int $sort;
	private ?ActiveValueObject $active;
	protected ?string $name;
	protected ?DescriptionValueObject $description;
	protected ?int $pictureId = null;
	protected ?int $cityId = null;
	protected array $buildObjects = [];
	protected ?ImportSettingValueObject $importSetting = null;

	protected ?ImageValueObject $picture = null;
	protected ?CityEntity $city = null;

	protected ?DeveloperSettingsValueObject $settings = null;

	public static function hydrate(
		?int                          $id,
		?string                       $name,
		?DescriptionValueObject       $description,
		?int                          $sort,
		?ActiveValueObject            $active,
		?int                          $pictureId = null,
		?int                          $cityId = null,
		?DeveloperSettingsValueObject $settings = null,
	): DeveloperEntity
	{
		$self = new self();
		$self->id = $id;
		$self->name = $name;
		$self->description = $description;
		$self->sort = $sort;
		$self->active = $active;
		$self->pictureId = $pictureId;
		$self->cityId = $cityId;
		$self->settings = $settings;
		return $self;
	}

	public function updateByAdmin(
		string                       $name,
		DescriptionValueObject       $description,
		int                          $sort,
		ActiveValueObject            $active,
		int                          $cityId = null,
		DeveloperSettingsValueObject $settings = null,
		int                          $pictureId = null,
	): DeveloperEntity
	{
		$this->name = $name;
		$this->description = $description;
		$this->sort = $sort;
		$this->active = $active;
		$this->cityId = $cityId;
		$this->settings = $settings;


		if($pictureId)
		{
			$this->pictureId = $pictureId;
		}


		return $this;
	}

	public function updateSettings(DeveloperSettingsValueObject $settings): DeveloperEntity
	{
		$this->settings = $settings;
		return $this;
	}

	public function addPicture(ImageValueObject $picture): DeveloperEntity
	{
		$this->picture = $picture;
		return $this;
	}

	public function addCity(CityEntity $city): DeveloperEntity
	{
		$this->city = $city;
		return $this;
	}

	public function addBuildObject(BuildObjectEntity $buildObject): DeveloperEntity
	{
		$this->buildObjects[] = $buildObject;
		return $this;
	}

	public function getImportSetting(): ?ImportSettingValueObject
	{
		return $this->importSetting;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getPicture(): ?ImageValueObject
	{
		return $this->picture;
	}

	/**
	 * @return BuildObjectEntity[]|null
	 */
	public function getBuildObjects(): ?array
	{
		return $this->buildObjects;
	}

	public function getCity(): ?CityEntity
	{
		return $this->city;
	}

	public function getCityId(): ?int
	{
		return $this->cityId;
	}

	public function getPictureId(): ?int
	{
		return $this->pictureId;
	}

	public function getSettings(): ?DeveloperSettingsValueObject
	{
		return $this->settings;
	}

	public function getActive(): ?ActiveValueObject
	{
		return $this->active;
	}

	public function getSort(): ?int
	{
		return $this->sort;
	}

	public function getDescription(): ?DescriptionValueObject
	{
		return $this->description;
	}
}