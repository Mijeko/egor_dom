<?php

namespace Craft\DDD\Stream\Application\Factory;

use Craft\DDD\Stream\Application\UseCase\ChatUseCase;
use Craft\DDD\Stream\Infrastructure\Repository\ChatMemberRepository;
use Craft\DDD\Stream\Infrastructure\Repository\ChatMessageRepository;
use Craft\DDD\Stream\Infrastructure\Repository\ChatRepository;

class ChatUseCaseFactory
{
	public static function getUseCase(): ChatUseCase
	{
		return new ChatUseCase(
			new ChatRepository(),
			new ChatMessageRepository(),
			new ChatMemberRepository(),
		);
	}
}