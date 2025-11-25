<?php

namespace Craft\Inertia\Manifest;

class Manifest
{
	private array $chunks = [];

	public function __construct(
		private string $pathToManifest,
	)
	{
		$this->handle();
	}

	public static function load(
		string $pathToManifest
	): Manifest
	{
		$self = new self(
			$pathToManifest,
		);
		return $self;
	}

	protected function handle(): void
	{
		$content = $this->readFile($this->pathToManifest);
		if(!$content)
		{
			return;
		}


		$this->chunks = $this->unJsoned($content);
	}

	public function chunk(string $chunkName): ?array
	{
		return $this->chunks[$chunkName];
	}


	protected function unJsoned(string $json): ?array
	{
		if(!json_validate($json))
		{
			return null;
		}

		return json_decode($json, true);
	}


	protected function readFile(string $path): ?string
	{
		$path = $_SERVER['DOCUMENT_ROOT'] . $path;

		if(!file_exists($path))
		{
			return null;
		}

		return file_get_contents($path);
	}
}