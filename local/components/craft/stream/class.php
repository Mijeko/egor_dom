<?php

use Craft\Core\Component\AjaxComponent;
use Craft\DDD\Stream\Application\Dto\ChatDto;
use Craft\DDD\Stream\Application\Dto\ChatMemberDto;
use Craft\DDD\Stream\Application\Dto\ChatMessageDto;
use Craft\DDD\Stream\Application\Factory\ChatServiceFactory;
use Craft\DDD\Stream\Application\Services\ChatService;
use Craft\DDD\Stream\Domain\Entity\ChatEntity;
use Craft\DDD\Stream\Domain\Entity\ChatMessageEntity;
use Craft\DDD\Stream\Infrastructure\Entity\ChatTable;
use Craft\Dto\BxImageDto;
use Craft\Helper\Criteria;

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