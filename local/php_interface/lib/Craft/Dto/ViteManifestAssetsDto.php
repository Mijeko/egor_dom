<?php

namespace Craft\Dto;

class ViteManifestAssetsDto
{
	public function __construct(
		public array $jsFiles = [],
		public array $cssFiles = [],
	)
	{
	}

	public static function build(
		array $jsFiles = [],
		array $cssFiles = []
	): static
	{
		return new static($jsFiles, $cssFiles);
	}

	public function addJs($file): static
	{
		$this->jsFiles[] = $file;
		return $this;
	}

	public function addCss($file): static
	{
		$this->cssFiles[] = $file;
		return $this;
	}

	public function getCssFiles(): array
	{
		return $this->cssFiles;
	}

	public function getJsFiles(): array
	{
		return $this->jsFiles;
	}
}