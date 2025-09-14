<?php

use Craft\Core\Component\AjaxComponent;

class CraftManagerCreateComponent extends AjaxComponent
{

	function componentNamespace(): string
	{
		return "craftManagerCreate";
	}

	protected function validate(array $postData): void
	{
	}

	protected function work(array $formData): void
	{
		try
		{

			\Craft\Core\Rest\ResponseBx::success([
				'asd' => rand(),
			]);

		} catch(Exception $e)
		{
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