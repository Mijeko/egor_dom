<?php

use Craft\Core\Component\AjaxComponent;
use Craft\Core\Rest\ResponseBx;
use Craft\DDD\User\Application\Dto\Request\RegisterRequestDto;
use Craft\DDD\User\Application\Factory\UseCase\RegisterUseCaseFactory;
use Craft\DDD\User\Application\UseCase\Register\RegisterUseCase;

class CraftRegisterSimpleComponent extends AjaxComponent
{

	private RegisterUseCase $registerUseCase;

	function componentNamespace(): string
	{
		return 'craftRegisterSimpleComponent';
	}

	protected function validate(array $postData): void
	{
	}

	protected function work(array $formData): void
	{
		try
		{
			$this->registerUseCase->execute(new RegisterRequestDto(
				$formData['email'],
				$formData['phone'],
				$formData['password'],
			));

			ResponseBx::success([
				rand() => rand(),
			]);
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
		$this->registerUseCase = RegisterUseCaseFactory::getUseCase();
	}
}