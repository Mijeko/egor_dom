<?php

use Craft\Core\Component\AjaxComponent;

class CraftDeveloperFeedLoadComponent extends AjaxComponent
{

	function componentNamespace(): string
	{
		return 'craftDeveloperFeedLoad';
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
		$this->arResult['SOURCE'][] = [];
	}

	public function loadServices(): void
	{
	}
}