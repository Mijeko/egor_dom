<?php

use Craft\Core\Component\AjaxComponent;

class CraftDeveloperOrderAcceptComponent extends AjaxComponent
{

	function componentNamespace(): string
	{
		return 'craftDeveloperOrderAccept';
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
	}

	public function loadServices(): void
	{
	}
}