<?php

namespace Craft\DDD\Stream\Application\UseCase;

use Craft\DDD\Stream\Domain\Entity\ChatEntity;
use Craft\DDD\Stream\Domain\Entity\ChatMemberEntity;
use Craft\DDD\Stream\Domain\Entity\ChatMessageEntity;
use Craft\DDD\Stream\Domain\Repository\ChatMessageRepositoryInterface;
use Craft\DDD\Stream\Domain\Repository\ChatRepositoryInterface;
use Craft\DDD\Stream\Infrastructure\Repository\ChatMemberRepository;

class ChatUseCase
{

	public function __construct(
		private ChatRepositoryInterface        $chatRepository,
		private ChatMessageRepositoryInterface $messageRepository,
		private ChatMemberRepository           $memberRepository,
	)
	{
	}

	public function sendMessage(
		?int   $chatId,
		int    $userId,
		int    $acceptUserId,
		string $text
	): void
	{
		if(!$chatId)
		{
			$this->createChatAndSendMessage($userId, $acceptUserId, $text);
		} else
		{
			$this->send($chatId, $userId, $text);
		}

	}

	private function createChatAndSendMessage(int $userId, int $acceptUserId, string $text): void
	{
		$chat = ChatEntity::createNewChat();
		$chat = $this->chatRepository->create($chat);

		$member1 = ChatMemberEntity::newChatMember($chat->getId(), $userId);
		$member1 = $this->memberRepository->create($member1);

		$member2 = ChatMemberEntity::newChatMember($chat->getId(), $acceptUserId);
		$member2 = $this->memberRepository->create($member2);


		$this->send($chat->getId(), $member1->getUserId(), $text);
	}

	private function send(int $chatId, int $userId, string $text): void
	{
		$chat = $this->chatRepository->findChatById($chatId);
		if(!$chat)
		{
			throw new \Exception("Чат не найден");
		}

		$chatMessage = ChatmessageEntity::createMessage(
			$chat,
			$userId,
			$text
		);

		$chatMessage = $this->messageRepository->create($chatMessage);
	}
}