<?php

namespace Craft\DDD\Developers\Infrastructure\Service\ImportHandler;


use Bitrix\Main\Diag\Debug;

/**
 * Обработчик для ГК Расцветай
 */
class BlossomHandler implements ImportHandlerInterface
{

	public function execute(string $xmlData): void
	{
		$read = new \SimpleXMLElement($xmlData);

		Debug::dumpToFile($read);
	}
}