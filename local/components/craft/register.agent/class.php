<?php

use Craft\DDD\User\Application\Dto\RegisterAgentDto;
use Craft\DDD\User\Application\Factory\RegisterAgentUseCaseFactory;

class CraftRegisterAgent extends \Craft\Core\Component\AjaxComponent
{
	function componentNamespace(): string
	{
		return "craftRegisterAgent";
	}

	protected function validate(array $postData): void
	{
	}

	protected function store(array $formData): void
	{
		try
		{
			$service = RegisterAgentUseCaseFactory::getService();
			$service->execute(
				new RegisterAgentDto(
					$formData['phone'],
					$formData['email'],
					$formData['password'],
					$formData['inn'],
					$formData['kpp'],
					$formData['ogrn'],
					$formData['bik'],
					$formData['currAcc'],
					$formData['corrAcc'],
					$formData['postAddress'],
					$formData['legalAddress'],
					$formData['bankName'],
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