<?php

namespace Craft\DDD\Stream\Application\UseCase;

use Craft\DDD\Stream\Domain\Entity\MessageEntity;
use Craft\DDD\Stream\Domain\Repository\ChatMessageRepositoryInterface;
use Craft\DDD\Stream\Domain\Repository\ChatRepositoryInterface;

class ChatUseCase
{

	public function __construct(
		private ChatRepositoryInterface        $repository,
		private ChatMessageRepositoryInterface $messageRepository,
	)
	{
	}

	public function sendMessage(int $userId, int $acceptUserId, string $message): void
	{
		$chat = $this->repository->findChatByUsers(
			$userId,
			$acceptUserId,
		);

		if(!$chat)
		{
			throw new \Exception('Чат не найден');
		}


		$message = MessageEntity::createMessage(
			$chat,
			$message
		);

		$message = $this->messageRepository->create($message);

	}
}