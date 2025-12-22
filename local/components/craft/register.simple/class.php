<?php

use Craft\Core\Component\AjaxComponent;
use Craft\Core\Rest\ResponseBx;
use Craft\DDD\User\Application\UseCase\RegisterSimpleUseCase;

class CraftRegisterSimpleComponent extends AjaxComponent
{

	private RegisterSimpleUseCase $uc;

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
		$this->uc = new RegisterSimpleUseCase();
	}
}