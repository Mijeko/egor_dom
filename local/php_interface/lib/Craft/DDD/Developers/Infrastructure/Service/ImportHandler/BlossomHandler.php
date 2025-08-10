<?php

namespace Craft\DDD\Developers\Infrastructure\Service\ImportHandler;

/**
 * Обработчик для ГК Расцветай
 */
class BlossomHandler implements ImportHandlerInterface
{
	public function __construct(
		protected ?ImportHandlerInterface $source = null,
	)
	{
	}

	public function execute(string $xmlData): void
	{
		if($this->source)
		{
			$this->source->execute($xmlData);
		}
	}
}