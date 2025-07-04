<?php

namespace Craft\DDD\Shared\Domain\ValueObject;

use CFile;

class ImageValueObject
{
	public function __construct(
		protected int    $id,
		protected string $src,
	)
	{
	}

	protected static function sourceFolder(): string
	{
		return '/upload/import_aparts/source/';
	}

	protected static function imageFolder(): string
	{
		return '/upload/import_aparts/';
	}

	protected static function generateImageName(): string
	{
		return time();
	}

	protected static function prepareFolders(): void
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

	protected static function getExtension($url): ?string
	{
		preg_match('/(\.png|\.jpg|\.webp|\.jpeg)$/iu', $url, $matches);

		if(!empty($matches[0]))
		{
			return $matches[0];
		}

		return null;
	}

	public static function fromId(int $id): ?static
	{
		$file = CFile::GetFileArray($id);
		if(!$file)
		{
			return null;
		}

		return new static(
			$file['ID'],
			$file['SRC']
		);
	}

	public static function fromUrl(?string $url, ?string $name = null): ?static
	{
		//		return null;
		if(!$url)
		{
			return null;
		}

		if(!$name)
		{
			$name = self::generateImageName();
		}

		self::prepareFolders();


		$fileName = $_SERVER['DOCUMENT_ROOT'] . self::sourceFolder() . $name . self::getExtension($url);

		file_put_contents($fileName, file_get_contents($url));


		$fileData = null;
		if(is_file($fileName))
		{
			$file = \CFile::MakeFileArray($fileName);
			if($file)
			{
				$fileId = CFile::SaveFile($file, self::imageFolder());

				if($fileId)
				{
					$fileData = CFile::GetFileArray($fileId);
				}
			}
		}

		if(!$fileData)
		{
			return null;
		}

		return new static(
			$fileData['ID'],
			$fileData['SRC'],
		);
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getSrc(): string
	{
		return $this->src;
	}
}