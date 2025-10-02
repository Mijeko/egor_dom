<?php

namespace Craft\DDD\Stream\Application\UseCase;

use Craft\DDD\Stream\Domain\Repository\ChatMessageRepositoryInterface;
use Craft\DDD\Stream\Domain\Repository\ChatRepositoryInterface;
use Craft\DDD\Stream\Infrastructure\Entity\ChatMemberTable;
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

	public function sendMessage(int $userId, int $chatId, string $message): void
	{
		$asChatMember = $this->memberRepository->findAll(Criteria::instance()->filter([
			ChatMemberTable::F_USER_ID => $userId,
			ChatMemberTable::F_CHAT_ID => $chatId,
		]));

		if(!$asChatMember)
		{

		}

	}
}