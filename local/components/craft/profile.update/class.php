<?php

use Craft\DDD\User\Application\Dto\ProfileUpdateServiceDto;
use Craft\DDD\User\Application\Factory\UpdateProfileUseCaseFactory;

class CraftProfileUpdateComponent extends \Craft\Core\Component\AjaxComponent
{

	function componentNamespace(): string
	{
		return 'craftProfileUpdate';
	}

	protected function validate(array $postData): void
	{
	}

	protected function store(array $formData): void
	{
		try
		{
			$profileId = $formData['profileId'];
			if(!$profileId)
			{
				throw new \Exception('Profile id is required');
			}

			unset($formData['profileId']);

			$service = UpdateProfileUseCaseFactory::getService();
			$service->execute(intval($profileId), ProfileUpdateServiceDto::fromArray($formData));

			\Craft\Core\Rest\Response::success([
				'success' => true,
				'message' => 'Успешно',
			]);

		} catch(\Exception $e)
		{
			\Craft\Core\Rest\Response::success([
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