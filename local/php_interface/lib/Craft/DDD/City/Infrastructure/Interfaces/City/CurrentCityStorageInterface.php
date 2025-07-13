<?php

namespace Craft\DDD\City\Infrastructure\Interfaces\City;

use Craft\DDD\City\Domain\Entity\CityEntity;

interface CurrentCityStorageInterface
{
	public function store(CityEntity $cityEntity): void;

	public function get(): int;

	public function clean(): void;

	public function has(): bool;
}