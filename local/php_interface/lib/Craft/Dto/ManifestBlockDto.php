<?php

namespace Craft\Dto;

use Craft\Core\Helper\DtoManager;

class ManifestBlockDto extends DtoManager
{
	public function __construct(
		protected ?string $file = null,
		protected array   $css = [],
		protected array   $assets = [],
		protected array   $imports = [],
	)
	{

	}

	public function addAsset(ManifestAssetItemDto $assetItemDto): static
	{
		$this->assets[] = $assetItemDto;
		return $this;
	}

	public function setAssets(array $assets): static
	{
		$this->assets = array_map(function(string $asset) {
			return new ManifestAssetItemDto($asset);
		}, $assets);
		return $this;
	}

	public function setCss(array $css): void
	{
		$this->css = $css;
	}

	public function setFile(?string $file): void
	{
		$this->file = $file;
	}

	public function setImports(array $imports): void
	{
		$this->imports = $imports;
	}

	/**
	 * @return ManifestAssetItemDto[]
	 */
	public function getAssets(): array
	{
		return $this->assets;
	}

	public function getCss(): array
	{
		return $this->css;
	}

	public function getFile(): ?string
	{
		return $this->file;
	}

	public function getImports(): array
	{
		return $this->imports;
	}
}