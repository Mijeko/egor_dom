<?php

namespace Craft\DDD\Developers\Infrastructure\Agents;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Developers\Infrastructure\Service\Factory\ImportServiceFactory;

class ImportAgent
{

	/**
	 * \CAgent::AddAgent(
	 * "Craft\DDD\Developers\Infrastructure\Agents\ImportAgent::execute();", // имя функции
	 * "craft.develop",                          // идентификатор модуля
	 * "N",                                  // агент не критичен к кол-ву запусков
	 * 86400,                                // интервал запуска - 1 сутки
	 * "07.12.2024 13:03:26",                // дата первой проверки на запуск
	 * "Y",                                  // агент активен
	 * "07.12.2024 13:03:26",                // дата первого запуска
	 * 30
	 * );
	 */
	public static function execute(): string
	{
		try
		{
			Debug::dumpToFile('ImportAgent.php has running', '', '__check_agent_run.log');
			$service = ImportServiceFactory::getService();
			$service->executeAll();
		} catch(\Exception $e)
		{
			Debug::dumpToFile($e->getMessage(), '', '__check_agent_err.log');
		}

		return "\\Craft\\DDD\\Developers\\Infrastructure\\Agents\\ImportAgent::execute();";
	}
}