<?php

namespace Craft\DDD\Shared\Application\Service;

use Craft\DDD\Shared\Infrastructure\Dto\ResultImageSaveDto;

interface ImageServiceInterface
{
	public function storeFromUrl(string $url): ?ResultImageSaveDto;

	public function findById(int $id): ?ResultImageSaveDto;
}