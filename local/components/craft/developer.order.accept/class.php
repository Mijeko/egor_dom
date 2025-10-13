<?php

use Craft\Core\Component\AjaxComponent;
use Craft\Core\Rest\ResponseBx;
use Craft\DDD\Claims\Application\Factory\ClaimManagerAcceptUseCaseFactory;
use Craft\DDD\Claims\Application\UseCase\ClaimAcceptDeveloperUseCase;

class CraftDeveloperOrderAcceptComponent extends AjaxComponent
{

	private ClaimAcceptDeveloperUseCase $useCase;


	function componentNamespace(): string
	{
		return 'craftDeveloperOrderAccept';
	}

	protected function validate(array $postData): void
	{
	}

	protected function work(array $formData): void
	{
		try
		{
			$claim = $this->useCase->execute(intval($formData['orderId']));

			ResponseBx::success([
				'success' => $claim,
			]);

		} catch(Exception $exception)
		{
			ResponseBx::badRequest($exception->getMessage());
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
		$this->useCase = ClaimManagerAcceptUseCaseFactory::getUseCase();
	}
}