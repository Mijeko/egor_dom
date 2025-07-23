<?php

use Craft\DDD\User\Application\Factory\AuthorizeServiceFactory;

class CraftAuthComponent extends \Craft\Core\Component\AjaxComponent
{
	function componentNamespace(): string
	{
		return 'craftAuthComponent';
	}

	protected function validate(array $postData): void
	{
	}


	protected function store(array $formData): void
	{
		try
		{
			$service = AuthorizeServiceFactory::getService();
			$service->execute($formData['phone'], $formData['password']);


			\Craft\Core\Rest\ResponseBx::success([
				'success'  => true,
				'redirect' => '/',
			]);
		} catch(\Exception $e)
		{
			\Craft\Core\Rest\ResponseBx::badRequest($e->getMessage());
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
	}
}