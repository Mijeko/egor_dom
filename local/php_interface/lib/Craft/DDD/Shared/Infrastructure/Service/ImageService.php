<?php

namespace Craft\DDD\Shared\Infrastructure\Service;

use Craft\DDD\Shared\Application\Service\ImageServiceInterface;
use Craft\DDD\Shared\Infrastructure\Dto\ResultImageSaveDto;
use Craft\Dto\BxImageDto;

class ImageService implements ImageServiceInterface
{

	public function findById(int $id): ?ResultImageSaveDto
	{
		$file = \CFile::GetFileArray($id);
		if(!$file)
		{
			return null;
		}

		return new ResultImageSaveDto(
			$file['ID'],
			$file['SRC'],
		);
	}

	public function storeFromUrl(string $url): ?ResultImageSaveDto
	{
		if(!$url)
		{
			return null;
		}

		$name = $this->generateImageName();

		$this->prepareFolders();


		$fileName = $_SERVER['DOCUMENT_ROOT'] . $this->sourceFolder() . $name . $this->getExtension($url);

		file_put_contents($fileName, file_get_contents($url));


		$fileData = null;
		if(is_file($fileName))
		{
			$file = \CFile::MakeFileArray($fileName);
			if($file)
			{
				$fileId = \CFile::SaveFile($file, $this->imageFolder());

				if($fileId)
				{
					$fileData = \CFile::GetFileArray($fileId);
				}
			}
		}

		if(!$fileData)
		{
			return null;
		}


		return new ResultImageSaveDto(
			$fileData['ID'],
			$fileData['SRC']
		);
	}

	protected function getExtension($url): ?string
	{
		preg_match('/(\.png|\.jpg|\.webp|\.jpeg)$/iu', $url, $matches);

		if(!empty($matches[0]))
		{
			return $matches[0];
		}

		return null;
	}

	protected static function generateImageName(): string
	{
		return time();
	}

	protected function prepareFolders(): void
	{

		if(!is_dir($_SERVER['DOCUMENT_ROOT'] . static::sourceFolder()))
		{
			mkdir($_SERVER['DOCUMENT_ROOT'] . static::sourceFolder());
		}

		if(!is_dir($_SERVER['DOCUMENT_ROOT'] . static::imageFolder()))
		{
			mkdir($_SERVER['DOCUMENT_ROOT'] . static::imageFolder());
		}

	}

	protected function sourceFolder(): string
	{
		return '/upload/import_aparts/source/';
	}

	protected function imageFolder(): string
	{
		return '/upload/import_aparts/';
	}

	public function transformBx(int $imageId): BxImageDto
	{
		$_img = $this->findById($imageId);

		return new BxImageDto(
			$_img->id,
			$_img->src,
		);
	}

	public function transformBxByArray(array $imageIdList): array
	{
		$result = [];

		foreach($imageIdList as $imageId)
		{
			$result[] = $this->transformBx($imageId);
		}

		return $result;
	}
}