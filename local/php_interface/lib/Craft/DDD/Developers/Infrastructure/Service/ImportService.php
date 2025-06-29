<?php

namespace Craft\DDD\Developers\Infrastructure\Service;

use Craft\DDD\Developers\Domain\Repository\DeveloperRepositoryInterface;

class ImportService
{

	public function __construct(
		protected DeveloperRepositoryInterface $developerRepository
	)
	{
	}

	public function execute(int $developerId, string $xmlBuildData): void
	{
		if(!$this->developerRepository->findById($developerId))
		{
			throw new \Exception('Застройщик не найден');
		}

		$read = new \SimpleXMLElement($xmlBuildData);
		foreach($read->offer as $offer)
		{
			$offer = json_decode(json_encode($offer), true);

			\Bitrix\Main\Diag\Debug::dumpToFile($offer);
		}
	}
}