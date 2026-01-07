<?php

use Craft\Core\Component\AjaxComponent;
use Craft\Core\Rest\ResponseBx;
use Craft\DDD\User\Application\Dto\Request\CreateManagerRequestDto;
use Craft\DDD\User\Application\Factory\UseCase\CreateManagerUseCaseFactory;
use Craft\DDD\User\Application\UseCase\Crud\CreateManagerUseCase;


class CraftManagerCreateComponent extends AjaxComponent
{

	protected ?CreateManagerUseCase $createManagerUseCase;

	function componentNamespace(): string
	{
		return "craftManagerCreate";
	}

	protected function validate(array $postData): void
	{
	}

	protected function work(array $formData): void
	{
		try
		{
			$this->createManagerUseCase->execute(
				new CreateManagerRequestDto(
					$formData['email'],
					$formData['phone'],
					$formData['name'],
					$formData['lastName'],
					$formData['secondName'],
				)
			);

			ResponseBx::success([]);

		} catch(Exception $e)
		{
			ResponseBx::badRequest($e->getMessage());
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
		$this->createManagerUseCase = CreateManagerUseCaseFactory::getUseCase();
	}
}