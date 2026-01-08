<?php

use Craft\Core\Component\AjaxComponent;
use Craft\Core\Rest\ResponseBx;
use Craft\DDD\Referal\Application\Facade\StorageManager;
use Craft\DDD\Referal\Application\Factory\AttachRefCodeToGuestUseCaseFactory;
use Craft\DDD\Referal\Application\UseCase\AttachRefCodeToGuestUseCase;
use Craft\DDD\User\Application\Dto\RegisterStudentByRefDto;
use Craft\DDD\User\Application\Factory\UseCase\RegisterStudentByReferralUseCaseFactory;
use Craft\DDD\User\Application\UseCase\Register\RegisterStudentByReferralUseCase;

class CraftRegisterStudent extends AjaxComponent
{
	protected ?RegisterStudentByReferralUseCase $registerStudentByReferralUseCase = null;
	protected ?StorageManager $storageManager = null;

	function componentNamespace(): string
	{
		return "craftRegisterStudent";
	}

	protected function validate(array $postData): void
	{
	}

	protected function work(array $formData): void
	{
		try
		{
			$refCode = $this->storageManager->getCode();

			$this->registerStudentByReferralUseCase->execute(
				new RegisterStudentByRefDto(
					$formData['phone'],
					$formData['email'],
					$formData['password'],
					$refCode,
				)
			);

			ResponseBx::success([
				'redirect' => '/',
			]);

		} catch(Exception $e)
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
		$this->registerStudentByReferralUseCase = RegisterStudentByReferralUseCaseFactory::getUseCase();
		$this->storageManager = StorageManager::instance();
	}
}