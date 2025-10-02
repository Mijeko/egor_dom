<?php

namespace Craft\DDD\Stream\Application\Services;

use Craft\DDD\Shared\Application\Service\ImageServiceInterface;
use Craft\DDD\Stream\Application\Dto\ChatMemberDto;
use Craft\DDD\Stream\Domain\Entity\ChatMemberEntity;
use Craft\DDD\Stream\Domain\Repository\MemberRepositoryInterface;
use Craft\DDD\User\Domain\Repository\UserRepositoryInterface;
use Craft\Dto\BxImageDto;
use Craft\Helper\Criteria;

class ChatMemberService
{

	public function __construct(
		private readonly MemberRepositoryInterface $memberRepository,
		private readonly ImageServiceInterface     $imageService,
		private readonly UserRepositoryInterface   $userRepository,
	)
	{
	}

	public function findChatIdListBetweenUsers(int $userId1, int $userId2): ?int
	{
		return $this->memberRepository->findChatBetweenUsers($userId1, $userId2);
	}

	/**
	 * @return array<int, ChatMemberDto>
	 */
	public function findAll(Criteria $criteria = null): array
	{
		$members = $this->memberRepository->findAll($criteria);


		return array_map(function(ChatMemberEntity $member) {

			$user = $this->userRepository->findById($member->getUserId());

			$avatar = null;
			$_image = $this->imageService->findById($user->getAvatarId());

			if($_image)
			{
				$avatar = new BxImageDto(
					$_image->id,
					$_image->src,
				);
			}

			return new ChatMemberDto(
				$member->getId(),
				$member->getChatId(),
				$member->getUserId(),
				$user->getName(),
				$avatar
			);
		}, $members);

	}
}