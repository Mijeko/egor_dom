<?php

use Craft\Core\Rest\ResponseBx;
use Craft\DDD\User\Application\Dto\RegisterStudentDto;
use Craft\DDD\User\Application\UseCase\RegisterStudentUseCase;
use Craft\DDD\User\Application\Factory\RegisterStudentUseCaseFactory;

class CraftRegisterStudent extends \Craft\Core\Component\AjaxComponent
{
	protected ?RegisterStudentUseCase $registerStudentUseCase = null;

	function componentNamespace(): string
	{
		return "craftRegisterStudent";
	}

	protected function validate(array $postData): void
	{
	}

	protected function store(array $formData): void
	{
		try
		{
			$service = RegisterStudentUseCaseFactory::getUseCase();
			$service->execute(
				new RegisterStudentDto(
					$formData['phone'],
					$formData['email'],
					$formData['password'],
				)
			);

			ResponseBx::success([
				'redirect' => '/',
			]);

		} catch(\Exception $e)
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
		$this->registerStudentUseCase = RegisterStudentUseCaseFactory::getUseCase();
	}
}