<?php

use Craft\Core\Component\AjaxComponent;
use Craft\Core\Rest\ResponseBx;
use Craft\DDD\User\Application\Dto\CreateAgentRequestDto;
use Craft\DDD\User\Application\Factory\CreateAgentUseCaseFactory;
use Craft\DDD\User\Application\UseCase\CreateAgentUseCase;

class CraftAgentCreateComponent extends AjaxComponent
{

	protected ?CreateAgentUseCase $createAgentUseCase;

	function componentNamespace(): string
	{
		return 'craftAgentCreate';
	}

	protected function validate(array $postData): void
	{
	}

	protected function work(array $formData): void
	{
		try
		{
			$this->createAgentUseCase->execute(new CreateAgentRequestDto(
				$formData['name'],
				$formData['lastName'],
				$formData['secondName'],
				$formData['email'],
				$formData['phone'],
				$formData['managerId'],
			));

			ResponseBx::success([]);

		} catch(Exception $e)
		{
			ResponseBx::badRequest($e->getMessage());
		}
	}

	protected function modules(): ?array
	{
		return null;
	}

	protected function loadData(): void
	{
	}

	public function loadServices(): void
	{
		$this->createAgentUseCase = CreateAgentUseCaseFactory::createUseCase();
	}
}