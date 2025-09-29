<?php

namespace Craft\DDD\Stream\Application\Services;

use Craft\DDD\Stream\Application\Dto\ChatDto;
use Craft\DDD\Stream\Application\Dto\ChatMemberDto;
use Craft\DDD\Stream\Application\Dto\ChatMessageDto;
use Craft\DDD\Stream\Domain\Entity\ChatEntity;
use Craft\DDD\Stream\Domain\Entity\MessageEntity;
use Craft\DDD\Stream\Domain\Repository\ChatMessageRepositoryInterface;
use Craft\DDD\Stream\Domain\Repository\ChatRepositoryInterface;
use Craft\DDD\Stream\Infrastructure\Entity\ChatMessageTable;
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

			$messages = array_map(function(MessageEntity $message) {
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


	//	public function findAll(Criteria $criteria = null): array
	//	{
	//		$chats = $this->chatRepository->findAll($criteria);
	//		$acceptMembers = $this->memberService->findAll(Criteria::instance()->filter([
	//			CraftUserTable::F_ID => array_map(function(ChatEntity $chat) {
	//				return $chat->getAcceptUserId();
	//			}, $chats),
	//		]));
	//		$messages = $this->chatMessageRepository->findAll(Criteria::instance()->filter([
	//			ChatMessageTable::F_CHAT_ID => array_map(function(ChatEntity $chat) {
	//				return $chat->getId();
	//			}, $chats),
	//		]));
	//
	//		return array_map(function(ChatEntity $chat) use ($messages, $acceptMembers) {
	//
	//			$messages = array_filter($messages, function(MessageEntity $message) use ($chat) {
	//				return $message->getChatId() === $chat->getId();
	//			});
	//
	//			foreach($messages as $message)
	//			{
	//				$chat->addMessage($message);
	//			}
	//
	//			$acceptMembers = array_filter($acceptMembers, function(MemberEntity $member) use ($chat) {
	//				return $member->getId() === $chat->getAcceptUserId();
	//			});
	//
	//			foreach($acceptMembers as $member)
	//			{
	//				$chat->addAcceptMember($member);
	//			}
	//
	//			return $chat;
	//		}, $chats);
	//	}
}