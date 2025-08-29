<?php

namespace Craft\DDD\Referal\Application\Service;

interface StorageInformationInterface
{
	public function store($data): void;

	public function getData(): array;
}