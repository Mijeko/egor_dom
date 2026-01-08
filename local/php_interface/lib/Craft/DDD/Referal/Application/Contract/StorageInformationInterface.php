<?php

namespace Craft\DDD\Referal\Application\Contract;

interface StorageInformationInterface
{
	public function store(array $data): void;

	public function getData(): array;
}