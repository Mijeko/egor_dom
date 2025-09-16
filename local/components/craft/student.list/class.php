<?php

use Craft\Core\Component\AjaxComponent;
use Craft\DDD\User\Domain\Entity\StudentEntity;
use Craft\DDD\User\Domain\Repository\StudentRepositoryInterface;
use Craft\DDD\User\Infrastructure\Repository\BxStudentRepository;
use Craft\Dto\BxUserDto;

class CraftStudentListComponent extends AjaxComponent
{
	protected StudentRepositoryInterface $studentRepository;

	function componentNamespace(): string
	{
		return 'craftStudentList';
	}

	protected function validate(array $postData): void
	{
	}

	protected function work(array $formData): void
	{
	}

	protected function modules(): ?array
	{
		return [];
	}

	protected function loadData(): void
	{
		$students = $this->studentRepository->findAll();

		$this->arResult['STUDENTS'] = array_map(function(StudentEntity $student) {
			return BxUserDto::student(
				$student->getId(),
				$student->getName(),
				$student->getLastName(),
				$student->getSecondName(),
				$student->getFullName(),
				$student->getEmail()->getValue(),
				$student->getPhone()->getValue(),
			);
		}, $students);
	}

	public function loadServices(): void
	{
		$this->studentRepository = new BxStudentRepository();
	}
}