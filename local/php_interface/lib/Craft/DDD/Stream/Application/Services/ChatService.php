<?php

namespace Craft\DDD\Stream\Application\Services;

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
			CraftUserTable::F_ID => array_map(function(ChatEntity $chat) {
				return $chat->getAcceptUserId();
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


			/** @var ChatMemberDto|null $acceptMember */
			$acceptMember = null;
			$acceptMembers = array_filter($acceptMembers, function(ChatMemberDto $chatMemberDto) use ($chat) {
				return $chat->getAcceptUserId() == $chatMemberDto->id;
			});

			if(count($acceptMembers) == 1)
			{
				$acceptMember = array_shift($acceptMembers);
			}


			$avatar = null;
			if($acceptMember && $acceptMember->avatar)
			{
				$avatar = new BxImageDto(
					$acceptMember->avatar->id,
					$acceptMember->avatar->src
				);
			}

			return new ChatDto(
				$chat->getId(),
				$chat->getUserId(),
				$chat->getAcceptUserId(),
				$messages,
				new ChatMemberDto(
					$acceptMember->id,
					$acceptMember->name,
					$avatar,
				)
			);

		}, $chats);
	}

	public function findAllByUserId(int $userId): array
	{
		$asMember = $this->chatMemberService->findAll(Criteria::instance()->filter([
			ChatMemberTable::F_USER_ID => $userId,
		]));

		if(count($asMember) <= 0)
		{
			return [];
		}

		return $this->findAll(Criteria::instance()->filter([
			ChatTable::F_ID => array_map(function(ChatMemberEntity $chat) {
				return $chat->getChatId();
			}, $asMember),
		]));
	}

	public function findChatBetweenUsers(int $userId1, int $userId2): ?ChatEntity
	{
		$chats = $this->chatMemberService->findAll(
			Criteria::instance()
				->filter([
					ChatMemberTable::F_USER_ID => [$userId1, $userId2],
				])
				->groupBy(ChatMemberTable::F_CHAT_ID)
		);

		if(count($chats) == 1)
		{
			return array_shift($chats);
		}

		return null;
	}
}