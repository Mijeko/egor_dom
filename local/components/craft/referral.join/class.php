<?php

use Craft\Core\Component\AjaxComponent;
use Craft\DDD\User\Application\Dto\RegisterStudentByRefDto;
use Craft\DDD\User\Application\Factory\RegisterStudentByReferralUseCaseFactory;
use Craft\DDD\User\Application\UseCase\RegisterStudentByReferralUseCase;

class CraftReferralJoinComponent extends AjaxComponent
{

	protected RegisterStudentByReferralUseCase $registerStudentByReferralUseCase;

	function componentNamespace(): string
	{
		return 'craftReferralJoin';
	}

	protected function validate(array $postData): void
	{
	}

	protected function work(array $formData): void
	{
		try
		{

			$this->registerStudentByReferralUseCase->registerByReferral(
				new RegisterStudentByRefDto(
					$formData['phone'],
					$formData['email'],
					$formData['password'],
					$this->arParams['CODE'] ?? ''
				)
			);

		} catch(Exception $exception)
		{

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
		$this->registerStudentByReferralUseCase = RegisterStudentByReferralUseCaseFactory::getUseCase();
	}
}