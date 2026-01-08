<?php

namespace Craft\DDD\Referal\Application\Contract;

interface StorageInformationInterface
{
	public function store($data): void;

	public function getData(): array;
}