<?php

namespace Craft\DDD\Stream\Application\Services;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Stream\Application\Dto\ChatDto;
use Craft\DDD\Stream\Application\Dto\ChatMemberDto;
use Craft\DDD\Stream\Application\Dto\ChatMessageDto;
use Craft\DDD\Stream\Domain\Entity\ChatEntity;
use Craft\DDD\Stream\Domain\Entity\ChatMemberEntity;
use Craft\DDD\Stream\Domain\Entity\ChatMessageEntity;
use Craft\DDD\Stream\Domain\Repository\ChatMessageRepositoryInterface;
use Craft\DDD\Stream\Domain\Repository\ChatRepositoryInterface;
use Craft\DDD\Stream\Infrastructure\Entity\ChatMemberTable;
use Craft\DDD\Stream\Infrastructure\Entity\ChatMessageTable;
use Craft\DDD\Stream\Infrastructure\Entity\ChatTable;
use Craft\Dto\BxImageDto;
use Craft\Helper\Criteria;
use Craft\Model\CraftUserTable;

class ChatService
{
	public function __construct(
		private readonly ChatRepositoryInterface        $chatRepository,
		private readonly ChatMessageRepositoryInterface $chatMessageRepository,
		private readonly ChatMemberService              $chatMemberService,
	)
	{
	}


	/**
	 * @return array<int, ChatDto>
	 */
	public function findAll(Criteria $criteria = null): array
	{
		$chats = $this->chatRepository->findAll($criteria);

		$acceptMembers = $this->chatMemberService->findAll(Criteria::instance()->filter([
			ChatMemberTable::F_CHAT_ID => array_map(function(ChatEntity $chat) {
				return $chat->getId();
			}, $chats),
		]));

		$messages = $this->chatMessageRepository->findAll(Criteria::instance()->filter([
			ChatMessageTable::F_CHAT_ID => array_map(function(ChatEntity $chat) {
				return $chat->getId();
			}, $chats),
		]));

		return array_map(function(ChatEntity $chat) use ($messages, $acceptMembers) {

			$messages = array_map(function(ChatMessageEntity $message) {
				return new  ChatMessageDto(
					$message->getId(),
					$message->getChatId(),
					$message->getMessage(),
				);

			}, $messages);


			return new ChatDto(
				$chat->getId(),
				$messages,
				$acceptMembers,
			);

		}, $chats);
	}


	/**
	 * @return array<int, ChatDto>
	 */
	public function findAllByUserId(int $userId): array
	{
		$asMember = $this->chatMemberService->findAll(Criteria::instance()->filter([
			ChatMemberTable::F_USER_ID => $userId,
		]));

		if(count($asMember) <= 0)
		{
			return [];
		}

		$chatList = $this->findAll(Criteria::instance()->filter([
			ChatTable::F_ID => array_map(function(ChatMemberDto $chatMemberDto) {
				return $chatMemberDto->chatId;
			}, $asMember),
		]));

		return $chatList;
	}

	public function findChatBetweenUsers(int $userId1, int $userId2): ?ChatEntity
	{
		$chatId = $this->chatMemberService->findChatIdListBetweenUsers($userId1, $userId2);
		if($chatId)
		{
			$chat = $this->chatRepository->findChatById($chatId);
			if($chat)
			{
				return $chat;
			}
		}

		return null;
	}
}