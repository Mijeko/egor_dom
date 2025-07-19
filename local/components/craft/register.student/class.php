<?php

use Craft\DDD\User\Application\Dto\RegisterStudentDto;
use Craft\DDD\User\Application\Service\Factory\RegisterStudentServiceFactory;

class CraftRegisterStudent extends \Craft\Core\Component\AjaxComponent
{
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
			$service = RegisterStudentServiceFactory::getService();
			$service->execute(
				new RegisterStudentDto(
					$formData['phone'],
					$formData['email'],
					$formData['password'],
				)
			);

			\Craft\Core\Rest\Response::success([
				'success' => true,
			]);

		} catch(\Exception $e)
		{
			\Craft\Core\Rest\Response::badRequest([
				'success' => false,
				'error'   => $e->getMessage(),
			]);
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