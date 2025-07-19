<?php

use Craft\DDD\User\Application\Service\Factory\AuthorizeServiceFactory;

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
			if($service->execute($formData['phone'], $formData['password']))
			{
				\Craft\Core\Rest\Response::success([
					'success'  => true,
					'redirect' => '/',
				]);
			}
		} catch(\Exception $e)
		{
			\Craft\Core\Rest\Response::badRequest($e->getMessage());
		}

		\Craft\Core\Rest\Response::success();
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