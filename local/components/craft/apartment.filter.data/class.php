<?php

use Bitrix\Main\Diag\Debug;
use Craft\Core\Component\AjaxComponent;
use Craft\Core\Rest\ResponseBx;
use Craft\DDD\Developers\Domain\Entity\BuildObjectEntity;
use Craft\DDD\Developers\Domain\Entity\DeveloperEntity;
use Craft\DDD\Developers\Domain\Repository\BuildObjectRepositoryInterface;
use Craft\DDD\Developers\Domain\Repository\DeveloperRepositoryInterface;
use Craft\DDD\Developers\Infrastructure\Repository\OrmBuildObjectRepository;
use Craft\DDD\Developers\Infrastructure\Repository\OrmDeveloperRepository;
use Craft\Dto\ApartmentFilterDataDto;
use Craft\Dto\ApartmentFilterPropDto;
use Craft\Dto\ApartmentFilterPropValueDto;

class CraftApartmentFilterData extends AjaxComponent
{
	protected DeveloperRepositoryInterface $developerRepository;
	protected BuildObjectRepositoryInterface $buildObjectRepository;

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
		$buildObjectList = $this->buildObjectRepository->findAll();

		$responseData = [
			'filter' => new ApartmentFilterDataDto([
				ApartmentFilterPropDto::build('Сан-узел', 'bathroom', 'checkbox', [
					ApartmentFilterPropValueDto::build('union', 'Совмещенный'),
					ApartmentFilterPropValueDto::build('split', 'Раздельный'),
				]),
				ApartmentFilterPropDto::build('Застройщик', 'developer', 'select', array_map(function(DeveloperEntity $developer) {
					return ApartmentFilterPropValueDto::build($developer->getId(), $developer->getName());
				}, $developers)),
				ApartmentFilterPropDto::build('Жилой комплекс', 'buildObjectList', 'select', array_map(function(BuildObjectEntity $buildObject) {
					return ApartmentFilterPropValueDto::build($buildObject->getId(), $buildObject->getName());
				}, $buildObjectList)),
				ApartmentFilterPropDto::build('Отделка', 'renovation', 'checkbox', [
					ApartmentFilterPropValueDto::build('clean', 'Чистовая'),
					ApartmentFilterPropValueDto::build('repair', 'С ремонтом'),
				]),
			]),
		];

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
		$this->buildObjectRepository = new OrmBuildObjectRepository();
	}
}