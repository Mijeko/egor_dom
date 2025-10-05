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

		$allMembersToAllChat = $this->chatMemberService->findAll(Criteria::instance()->filter([
			ChatMemberTable::F_CHAT_ID => array_map(function(ChatEntity $chat) {
				return $chat->getId();
			}, $chats),
		]));

		$messages = $this->chatMessageRepository->findAll(Criteria::instance()->filter([
			ChatMessageTable::F_CHAT_ID => array_map(function(ChatEntity $chat) {
				return $chat->getId();
			}, $chats),
		]));

		return array_map(function(ChatEntity $chat) use ($messages, $allMembersToAllChat) {

			$messages = array_filter($messages, function(ChatMessageEntity $message) use ($chat) {
				return $message->getChatId() === $chat->getId();
			});
			$messages = array_values($messages);

			$messages = array_map(function(ChatMessageEntity $message) {
				return new  ChatMessageDto(
					$message->getId(),
					$message->getUserId(),
					$message->getChatId(),
					$message->getMessage(),
				);

			}, $messages);


			$members = array_filter($allMembersToAllChat, function(ChatMemberDto $member) use ($chat) {
				return $chat->getId() == $member->chatId;
			});

			$members = array_values($members);

			return new ChatDto(
				$chat->getId(),
				$messages,
				$members,
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

		$chatIdList = array_map(function(ChatMemberDto $chatMemberDto) {
			return $chatMemberDto->chatId;
		}, $asMember);

		$chatList = $this->findAll(Criteria::instance()->filter([
			ChatTable::F_ID => $chatIdList,
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