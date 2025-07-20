<?php

namespace Craft\DDD\Developers\Infrastructure\Entity;

use Bitrix\Main\Diag\Debug;

class Developer extends EO_Developer
{

	const HANDLER_FIRST_DEVELOP = 'firstDevelop';
	const HANDLER_RASCVET = 'rasvet';

	public static function getImportHandlers(): array
	{
		return [
			self::HANDLER_FIRST_DEVELOP => 'Первый строительный',
			self::HANDLER_RASCVET       => 'ГК Расцветай',
		];
	}

	public function addImportSettings(?string $handler, ?array $linkSource): static
	{
		foreach($linkSource as $index => $link)
		{
			if(mb_strlen($link) <= 0)
			{
				unset($linkSource[$index]);
			}
		}


		$this->setImportSettings(json_encode([
			'handler'    => $handler,
			'linkSource' => $linkSource,
		]));
		return $this;
	}


	public function importSettings(): ImportSettings
	{
		$rawData = json_decode($this->getImportSettings(), true);
		return new ImportSettings(
			$rawData['handler'],
			is_array($rawData['linkSource']) ? $rawData['linkSource'] : []
		);
	}
}


class ImportSettings
{
	public function __construct(
		protected ?string $handler,
		protected ?array  $linkSource
	)
	{
	}

	public function getHandler(): ?string
	{
		return $this->handler;
	}

	public function getLinkSource(): ?array
	{
		return $this->linkSource;
	}
}