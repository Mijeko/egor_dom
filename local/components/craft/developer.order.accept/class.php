<?php

use Craft\Core\Component\AjaxComponent;
use Craft\Core\Rest\ResponseBx;
use Craft\DDD\Claims\Domain\Repository\ClaimRepositoryInterface;
use Craft\DDD\Claims\Infrastructure\Repository\OrmClaimRepository;

class CraftDeveloperOrderAcceptComponent extends AjaxComponent
{

	protected ?ClaimRepositoryInterface $claimRepository = null;

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
			$claim = $this->claimRepository->findById($this->arParams['ORDER_ID']);
			if(!$claim)
			{
				throw new \Exception("Заказ не найден");
			}

			$claim->developerAccept();

			$claim = $this->claimRepository->update($claim);

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
		$this->claimRepository = new OrmClaimRepository();
	}
}