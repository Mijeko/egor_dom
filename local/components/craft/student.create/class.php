<?php

use Craft\Core\Component\AjaxComponent;
use Craft\Core\Rest\ResponseBx;
use Craft\DDD\User\Application\Dto\Request\CreateStudentRequestDto;
use Craft\DDD\User\Application\Factory\UseCase\CreateStudentUseCaseFactory;
use Craft\DDD\User\Application\UseCase\Crud\CreateStudentUseCase;

class CraftStudentCreateComponent extends AjaxComponent
{

	protected ?CreateStudentUseCase $createStudentUseCase;

	function componentNamespace(): string
	{
		return 'craftStudentCreate';
	}

	protected function validate(array $postData): void
	{
	}

	protected function work(array $formData): void
	{
		try
		{
			$this->createStudentUseCase->execute(new CreateStudentRequestDto(
				$formData['name'],
				$formData['lastName'],
				$formData['secondName'],
				$formData['phone'],
				$formData['email'],
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
		return [];
	}

	protected function loadData(): void
	{
	}

	public function loadServices(): void
	{
		$this->createStudentUseCase = CreateStudentUseCaseFactory::getUseCase();
	}
}