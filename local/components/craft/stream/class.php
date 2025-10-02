<?php

use Craft\Core\Component\AjaxComponent;
use Craft\DDD\Stream\Application\Factory\ChatServiceFactory;
use Craft\DDD\Stream\Application\Services\ChatService;


class CraftStreamComponent extends AjaxComponent
{

	private ChatService $chatService;

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
		$this->arResult['CHATS'] = $this->chatService->findAllByUserId($this->arParams['USER_ID']);
	}

	public function loadServices(): void
	{
		$this->chatService = ChatServiceFactory::getService();
	}
}