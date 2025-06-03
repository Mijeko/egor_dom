<?php

namespace Craft\Dto;

class ManifestAssetItemDto
{

	protected ?string $extension;

	public function __construct(
		protected string $asset
	)
	{
		$fileData = explode('.', $asset);
		if($fileData[1])
		{
			$this->extension = $fileData[1];
		}
	}

	public function getFile(): string
	{
		return $this->asset;
	}

	public function getExtension(): string
	{
		return $this->extension;
	}

	public function isImage(): bool
	{
		return true;
	}

	public function isFont(): bool
	{
		return in_array($this->extension, ['woff', 'woff2']);
	}
}