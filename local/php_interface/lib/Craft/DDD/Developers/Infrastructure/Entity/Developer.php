<?php

namespace Craft\DDD\Developers\Infrastructure\Entity;
class Developer extends EO_Developer
{

	const HANDLER_FIRST_DEVELOP = 'firstDevelop';

	public static function getImportHandlers(): array
	{
		return [
			self::HANDLER_FIRST_DEVELOP => 'Первый строительный',
		];
	}

	public function addImportSettings(?string $handler, ?string $linkSource): static
	{
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
			$rawData['linkSource']
		);
	}
}


class ImportSettings
{
	public function __construct(
		protected ?string $handler,
		protected ?string $linkSource
	)
	{
	}

	public function getHandler(): ?string
	{
		return $this->handler;
	}

	public function getLinkSource(): ?string
	{
		return $this->linkSource;
	}
}