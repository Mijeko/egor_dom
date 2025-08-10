<?php

namespace Craft\DDD\Developers\Infrastructure\Service\ImportHandler;

class FirstDevelopHandler implements ImportHandlerInterface
{
	public function __construct(
		protected ?ImportHandlerInterface $source,
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