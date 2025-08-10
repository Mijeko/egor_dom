<?php

use Craft\Core\Component\AjaxComponent;
use Craft\Core\Rest\ResponseBx;
use Craft\DDD\Developers\Domain\Entity\DeveloperEntity;
use Craft\DDD\Developers\Domain\Repository\DeveloperRepositoryInterface;
use Craft\DDD\Developers\Infrastructure\Repository\OrmDeveloperRepository;
use Craft\Dto\ApartmentFilterDataDto;
use Craft\Dto\ApartmentFilterPropDto;
use Craft\Dto\ApartmentFilterPropValueDto;

class CraftApartmentFilterData extends AjaxComponent
{
	protected DeveloperRepositoryInterface $developerRepository;

	function componentNamespace(): string
	{
		return 'craftApartmentFilterData';
	}

	protected function validate(array $postData): void
	{
	}

	protected function work(array $formData): void
	{
		$developers = $this->developerRepository->findAll();

		$responseData = [
			'filter' => new ApartmentFilterDataDto([
				ApartmentFilterPropDto::build('Сан-узел', 'bathroom', 'checkbox', []),
				ApartmentFilterPropDto::build('Застройщик', 'developer', 'select', array_map(function(DeveloperEntity $developer) {
					return ApartmentFilterPropValueDto::build($developer->getId(), $developer->getName());
				}, $developers)),
				ApartmentFilterPropDto::build('Отделка', 'renovation', 'checkbox', []),
			]),
		];

		\Bitrix\Main\Diag\Debug::dumpToFile($responseData);

		ResponseBx::success($responseData);
	}

	protected function modules(): ?array
	{
		return [];
	}

	protected function loadData(): void
	{
	}

	public function loadServices(): void
	{
		$this->developerRepository = new OrmDeveloperRepository();
	}
}