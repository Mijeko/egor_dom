<?php

namespace Craft\DDD\Shared\Application\Service;

use Craft\DDD\Shared\Infrastructure\Dto\ResultImageSaveDto;

interface ImageServiceInterface
{
	public function fromUrl(string $url): ?ResultImageSaveDto;

	public function fromId(int $id): ?ResultImageSaveDto;
}