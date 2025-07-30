<?php

use Craft\Core\Rest\ResponseBx;
use Craft\DDD\User\Application\Dto\RegisterSimpleAgentDto;
use Craft\DDD\User\Application\UseCase\RegisterAgentUseCase;
use Craft\DDD\User\Application\Factory\RegisterAgentUseCaseFactory;

class CraftRegisterAgent extends \Craft\Core\Component\AjaxComponent
{
	protected RegisterAgentUseCase $registerAgentUseCase;

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
			$this->registerAgentUseCase->execute(
				new RegisterSimpleAgentDto(
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
		$this->registerAgentUseCase = RegisterAgentUseCaseFactory::getUseCase();
	}
}