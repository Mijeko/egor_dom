<?php

use Craft\Core\Component\AjaxComponent;
use Craft\Core\Rest\ResponseBx;
use Craft\DDD\Stream\Application\Dto\ChatDto;
use Craft\DDD\Stream\Application\Factory\ChatServiceFactory;
use Craft\DDD\Stream\Application\Services\ChatService;

class CraftStreamSearchChat extends AjaxComponent
{
	private ChatService $chatService;

	function componentNamespace(): string
	{
		return 'streamSearchChat';
	}

	protected function validate(array $postData): void
	{
	}

	protected function work(array $formData): void
	{
		try
		{
			$chat = $this->chatService->findChatBetweenUsers(
				intval($formData['userId']),
				intval($formData['acceptUserId']),
			);

			$chatDto = null;

			if($chat)
			{
				$chatDto = new ChatDto(
					$chat->getId(),
				);
			}

			ResponseBx::success([
				'chat' => $chatDto,
			]);

		} catch(Exception $e)
		{
			ResponseBx::badRequest($e->getMessage());
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
		$this->chatService = ChatServiceFactory::getService();
	}
}