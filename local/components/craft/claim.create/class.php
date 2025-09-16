<?php

use Craft\Core\Rest\ResponseBx;
use Craft\Core\Component\AjaxComponent;
use Craft\DDD\Claims\Present\Dto\ClaimDto;
use Craft\DDD\Claims\Application\Dto\ClaimCreateDto;
use Craft\DDD\Claims\Application\Factory\ClaimServiceFactory;

class CraftClaimCreateComponent extends AjaxComponent
{
	function componentNamespace(): string
	{
		return 'craftClaimCreate';
	}

	protected function validate(array $postData): void
	{
	}

	protected function work(array $formData): void
	{
		try
		{
			$service = ClaimServiceFactory::getClaimService();
			$claim = $service->createClientClaim(new ClaimCreateDto(
				$formData['apartmentId'],
				$formData['userId'],
				$formData['email'],
				$formData['phone'],
				$formData['client'],
			));

			ResponseBx::success([
				'claim' => ClaimDto::fromEntity($claim),
			]);
		} catch(\Exception $e)
		{
			ResponseBx::badRequest($e->getMessage());
		}
	}

	protected function modules(): ?array
	{
		return ['craft.core'];
	}

	protected function loadData(): void
	{
	}

	public function loadServices(): void
	{
	}
}