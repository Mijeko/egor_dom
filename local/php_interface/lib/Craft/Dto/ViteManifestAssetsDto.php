<?php

namespace Craft\Dto;

class ViteManifestAssetsDto
{
	public function __construct(
		public array $jsFiles = [],
		public array $cssFiles = [],
		public array $fonts = [],
	)
	{
	}

	public static function build(
		array $jsFiles = [],
		array $cssFiles = [],
		array $fonts = [],
	): static
	{
		return new static(
			$jsFiles,
			$cssFiles,
			$fonts
		);
	}

	public function addFont(string $file): static
	{
		$this->fonts[] = $file;
		return $this;
	}

	public function addJs(string $file): static
	{
		$this->jsFiles[] = $file;
		return $this;
	}

	public function addCss(string $file): static
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