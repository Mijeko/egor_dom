<?php

namespace Craft\DDD\Stream\Application\UseCase;

use Craft\DDD\Stream\Domain\Entity\ChatEntity;
use Craft\DDD\Stream\Domain\Entity\ChatMemberEntity;
use Craft\DDD\Stream\Domain\Entity\ChatMessageEntity;
use Craft\DDD\Stream\Domain\Repository\ChatMessageRepositoryInterface;
use Craft\DDD\Stream\Domain\Repository\ChatRepositoryInterface;
use Craft\DDD\Stream\Infrastructure\Entity\ChatMemberTable;
use Craft\DDD\Stream\Infrastructure\Entity\ChatTable;
use Craft\DDD\Stream\Infrastructure\Repository\ChatMemberRepository;
use Craft\Helper\Criteria;

class ChatUseCase
{

	public function __construct(
		private ChatRepositoryInterface        $repository,
		private ChatMessageRepositoryInterface $messageRepository,
		private ChatMemberRepository           $memberRepository,
	)
	{
	}

	public function sendMessage(int $userId, int $acceptUserId, string $message): void
	{
		$asMember = $this->memberRepository->findAll(Criteria::instance()->filter([
			ChatMemberTable::F_USER_ID => $userId,
		]));

		$chatId = array_map(function(ChatMemberEntity $member) {
			return $member->getChatId();
		}, $asMember);

		$chat = $this->repository->findAll(Criteria::instance()->filter([
			ChatTable::F_ID => $chatId,
		]));

		if(!$chat)
		{
			$chat = ChatEntity::createNewChat(
				$userId,
				$acceptUserId,
			);

			$chat = $this->repository->createChat($chat);

			if(!$chat)
			{
				throw new \Exception("Ошибка при создании чата");
			}
		}
	}
}