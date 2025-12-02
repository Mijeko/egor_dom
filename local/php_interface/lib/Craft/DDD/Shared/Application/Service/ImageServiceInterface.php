<?php

namespace Craft\DDD\Shared\Application\Service;

use Craft\DDD\Shared\Infrastructure\Dto\ResultImageSaveDto;
use Craft\Dto\BxImageDto;

interface ImageServiceInterface
{
	public function storeFromArray(array $imageData): ?ResultImageSaveDto;

	public function storeFromUrl(string $url): ?ResultImageSaveDto;

	public function findById(int $id): ?ResultImageSaveDto;

	public function transformBx(int $imageId): BxImageDto;

	/**
	 * @return array<int, BxImageDto>
	 */
	public function transformBxList(array $imageIdList): array;

	public function transformBxByArray(array $imageIdList): array;

}