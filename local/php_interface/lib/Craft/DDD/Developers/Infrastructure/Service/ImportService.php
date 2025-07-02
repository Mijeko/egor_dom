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

	public function execute(int $developerId): void
	{
		$this->developer = $this->developerService->findById($developerId);
		if(!$this->developer)
		{
			throw new \Exception('Застройщик не найден');
		}


		$xmlBuildData = $this->readData($this->developer);
		$handler = $this->getHandler($this->developer->getImportSetting());

		if($handler)
		{
			$handler->execute($xmlBuildData);
		}

	}

	public function getHandler(ImportSettingValueObject $setting): ?ImportHandlerInterface
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

	public function readData(DeveloperEntity $developerEntity): string
	{
		if(!$developerEntity->getImportSetting()->getHandler())
		{
			throw new \Exception('Обработчик для выбранного застройщика не определен');
		}

		if(!$developerEntity->getImportSetting()->getSourceLink())
		{
			throw new \Exception('Ссылка на источник данных не определена');
		}

		$content = null;
		$cache = \Bitrix\Main\Data\Cache::createInstance(); // получаем экземпляр класса
		if($cache->initCache(7200, "importReadData_" . $developerEntity->getId()))
		{
			$vars = $cache->getVars();
			$content = $vars['xmlData'];
		} elseif($cache->startDataCache())
		{
			$content = $this->reader($developerEntity->getImportSetting()->getSourceLink());
			$cache->endDataCache(["xmlData" => $content]);
		}

		$content = $this->reader($developerEntity->getImportSetting()->getSourceLink());;

		if(!$content)
		{
			throw new \Exception('Содержимое ответа источника данных пустое');
		}

		return $content;
	}

	public function reader(string $url): ?string
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