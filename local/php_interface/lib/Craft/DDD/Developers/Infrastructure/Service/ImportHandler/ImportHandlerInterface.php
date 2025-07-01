<?php

namespace Craft\DDD\Developers\Infrastructure\Service\ImportHandler;

interface ImportHandlerInterface
{
	public function execute(string $xmlData): void;
}