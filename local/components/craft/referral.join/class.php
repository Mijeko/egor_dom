<?php

use Craft\Core\Component\AjaxComponent;
use Craft\DDD\User\Application\Dto\RegisterStudentByRefDto;
use Craft\DDD\User\Application\Factory\UseCase\RegisterStudentByReferralUseCaseFactory;
use Craft\DDD\User\Application\UseCase\Register\RegisterStudentByReferralUseCase;

class CraftReferralJoinComponent extends AjaxComponent
{

	public function onPrepareComponentParams($arParams)
	{
		$arParams = parent::onPrepareComponentParams($arParams);

		if(empty($arParams['CODE']))
		{
			throw new Exception('Реферальный код не передан');
		}

		return $arParams;
	}

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

			$this->registerStudentByReferralUseCase->execute(
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