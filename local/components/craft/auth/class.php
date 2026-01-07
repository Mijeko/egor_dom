<?php

use Craft\Core\Rest\ResponseBx;
use Craft\Core\Component\AjaxComponent;
use Craft\DDD\User\Application\Factory\UseCase\AuthorizeUseCaseFactory;
use Craft\DDD\User\Application\UseCase\Signin\AuthorizeUseCase;

class CraftAuthComponent extends AjaxComponent
{

	protected ?AuthorizeUseCase $authorizeUseCase = null;

	function componentNamespace(): string
	{
		return 'craftAuthComponent';
	}

	protected function validate(array $postData): void
	{
	}


	protected function work(array $formData): void
	{
		try
		{
			$this->authorizeUseCase->execute($formData['phone'], $formData['password']);

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
		$this->authorizeUseCase = AuthorizeUseCaseFactory::getService();
	}
}