<?php

namespace Craft\Phpunit\Fakes\Storage;

use Craft\DDD\Referal\Application\Contract\StorageInformationInterface;

class ArrayStorageInformation implements StorageInformationInterface
{
	private array $data = [];

	public function store(array $data): void
	{
		$this->data = $data;
	}

	public function getData(): array
	{
		return $this->data;
	}
}