<?php

namespace Craft\DDD\Developers\Infrastructure\Service;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Developers\Application\Service\ApartmentService;
use Craft\DDD\Developers\Application\Service\BuildObjectService;
use Craft\DDD\Developers\Application\Service\DeveloperService;
use Craft\DDD\Developers\Domain\Entity\DeveloperEntity;
use Craft\DDD\Developers\Domain\ValueObject\ImportSettingValueObject;
use Craft\DDD\Developers\Infrastructure\Entity\Developer;
use Craft\DDD\Developers\Infrastructure\Service\ImportHandler\BlossomHandler;
use Craft\DDD\Developers\Infrastructure\Service\ImportHandler\FirstDevelopHandler;
use Craft\DDD\Developers\Infrastructure\Service\ImportHandler\ImportHandlerInterface;

class ImportService
{

	protected ?DeveloperEntity $developer = null;

	public function __construct(
		protected DeveloperService   $developerService,
		protected BuildObjectService $buildObjectService,
		protected ApartmentService   $apartmentService,
	)
	{
	}

	/**
	 * @throws \Exception
	 */
	public function executeById(int $developerId): void
	{
		$this->developer = $this->developerService->findById($developerId);
		if(!$this->developer)
		{
			throw new \Exception('Застройщик не найден');
		}


		$sourceLinkList = $this->developer->getImportSetting()->getSourceLink();

		foreach($sourceLinkList as $sourceLink)
		{
			$xmlBuildData = $this->readData($sourceLink);
			$handler = $this->getHandler($this->developer->getImportSetting());

			if($handler)
			{
				$handler->execute($xmlBuildData);
			}
		}

	}

	public function executeAll(): void
	{
		try
		{
			$developers = $this->developerService->findAll();
			foreach($developers as $developer)
			{
				$this->executeById($developer->getId());
			}
		} catch(\Exception $exception)
		{

		}
	}

	private function getHandler(ImportSettingValueObject $setting): ?ImportHandlerInterface
	{
		switch($setting->getHandler())
		{
			case Developer::HANDLER_FIRST_DEVELOP:
				return new FirstDevelopHandler(
					$this->apartmentService,
					$this->developer,
				);

			case Developer::HANDLER_RASCVET:
				return new BlossomHandler(
					$this->apartmentService,
					$this->developer,
				);
			default:
				return null;
		}
	}

	private function readData(string $sourceLink): string
	{
		$content = null;
		$cache = \Bitrix\Main\Data\Cache::createInstance(); // получаем экземпляр класса
		if($cache->initCache(7200, "importReadData_" . md5($sourceLink)))
		{
			$vars = $cache->getVars();
			$content = $vars['xmlData'];
		} elseif($cache->startDataCache())
		{
			$content = $this->reader($sourceLink);
			$cache->endDataCache(["xmlData" => $content]);
		}

		if(!$content)
		{
			throw new \Exception('Содержимое ответа источника данных пустое');
		}

		return $content;
	}

	private function reader(string $url): ?string
	{
		$ch = curl_init($url);

		// Базовые опции
		curl_setopt_array($ch, [
			CURLOPT_RETURNTRANSFER => true,     // Возвращать результат
			CURLOPT_FOLLOWLOCATION => true,     // Следовать редиректам
			CURLOPT_SSL_VERIFYPEER => true,     // Проверка SSL (для продакшена)
			CURLOPT_TIMEOUT        => 30,              // Таймаут 30 секунд
			CURLOPT_USERAGENT      => 'My-Custom-Agent/1.0', // Пользовательский агент
		]);

		// Выполнение запроса
		$response = curl_exec($ch);

		// Проверка HTTP-статуса
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($httpCode !== 200)
		{
			throw new \Exception('Ошибка чтения выгрузки застройщика');
		}

		// Закрытие
		curl_close($ch);

		return $response;
	}
}