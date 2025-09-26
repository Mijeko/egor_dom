<?php

class CraftStreamComponent extends \Craft\Core\Component\AjaxComponent
{

	function componentNamespace(): string
	{
		return 'craftStream';
	}

	protected function validate(array $postData): void
	{
	}

	protected function work(array $formData): void
	{
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
	}
}