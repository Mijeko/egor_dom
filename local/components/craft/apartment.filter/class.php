<?php

use Craft\Core\Rest\ResponseBx;
use Craft\Core\Component\AjaxComponent;
use Craft\DDD\Developers\Application\Dto\ApartmentFilterDto;
use Craft\DDD\Developers\Application\Dto\ApartmentPreFilterDto;
use Craft\DDD\Developers\Application\UseCase\ApartmentFilterUseCase;
use Craft\DDD\Developers\Application\UseCase\ApartmentPreFilterUseCase;
use Craft\DDD\Developers\Application\Factory\ApartmentPreFilterUseCaseFactory;
use Craft\DDD\Developers\Application\Factory\ApartmentFilterUseCaseFactory;

class CraftApartmentFilterComponent extends AjaxComponent
{
	protected ?ApartmentPreFilterUseCase $apartmentPreFilterService;
	protected ?ApartmentFilterUseCase $apartmentFilterUseCase;

	function componentNamespace(): string
	{
		return 'apartmentFilterComponent';
	}

	protected function validate(array $postData): void
	{
	}

	protected function store(array $formData): void
	{
		switch($formData['action'])
		{
			case 'prefilter':

				$apartmentsCount = $this->apartmentPreFilterService->execute(
					new ApartmentPreFilterDto(
						$formData['price']['min'],
						$formData['price']['max'],
						$formData['bathroom'],
						$formData['renovation'],
						$formData['floorsTotal'],
						$formData['roomsTotal'],
						$formData['floor'],
					)
				);

				ResponseBx::success([
					'count' => $apartmentsCount,
				]);

				break;
			default:

				$apartments = $this->apartmentFilterUseCase->execute(
					new ApartmentFilterDto(
						$formData['price']['min'],
						$formData['price']['max'],
						$formData['bathroom'],
						$formData['renovation'],
						$formData['floorsTotal'],
						$formData['roomsTotal'],
						$formData['floor'],
					)
				);


				ResponseBx::success($apartments);

				break;
		}
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
		$this->apartmentPreFilterService = ApartmentPreFilterUseCaseFactory::getService();
		$this->apartmentFilterUseCase = ApartmentFilterUseCaseFactory::getService();
	}
}