<?php

namespace Craft\DDD\Developers\Domain\Entity;

use Craft\DDD\Developers\Domain\ValueObject\ImportSettingValueObject;
use Craft\Dto\BxImageDto;

/**
 *
 * @property BuildObjectEntity[] $buildObjects
 */
class DeveloperEntity
{
	public function __construct(
		public ?int                         $id,
		public ?string                      $name,
		public ?BxImageDto                  $picture = null,
		protected ?array                    $buildObjects = null,
		protected ?ImportSettingValueObject $importSetting = null,
	)
	{
	}

	public function addBuildObject(BuildObjectEntity $buildObject): static
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

	public function getPicture(): BxImageDto
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
}