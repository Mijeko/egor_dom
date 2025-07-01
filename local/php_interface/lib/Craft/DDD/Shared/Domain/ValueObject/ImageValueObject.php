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

	public static function fromUrl(?string $url, ?string $name = null): ?static
	{
		if(!$url)
		{
			return null;
		}

		if(!$name)
		{
			$name = self::generateImageName();
		}

		file_put_contents(self::sourceFolder() . $name, file_get_contents($url));


		$fileData = null;
		if(is_file($_SERVER['DOCUMENT_ROOT'] . self::sourceFolder() . $name))
		{
			$file = \CFile::MakeFileArray($_SERVER['DOCUMENT_ROOT'] . self::sourceFolder() . $name);
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