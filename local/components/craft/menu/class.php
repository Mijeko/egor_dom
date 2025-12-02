<?php

use Craft\Core\Component\AjaxComponent;

class CraftMenuComponent extends AjaxComponent
{
	function componentNamespace(): string
	{
		return 'craftMenuComponent';
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