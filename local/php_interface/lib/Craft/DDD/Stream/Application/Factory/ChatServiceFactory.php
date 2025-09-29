<?php

namespace Craft\DDD\Stream\Application\Factory;

use Craft\DDD\Stream\Application\Services\ChatService;
use Craft\DDD\Stream\Infrastructure\Repository\ChatMessageRepository;
use Craft\DDD\Stream\Infrastructure\Repository\ChatRepository;

class ChatServiceFactory
{
	public static function getService(): ChatService
	{
		return new ChatService(
			new ChatRepository(),
			new ChatMessageRepository(),
			ChatMemberServiceFactory::getService()
		);
	}
}