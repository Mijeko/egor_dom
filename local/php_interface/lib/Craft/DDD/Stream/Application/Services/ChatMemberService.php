<?php

namespace Craft\DDD\Stream\Application\Services;

use Craft\DDD\Shared\Application\Service\ImageServiceInterface;
use Craft\DDD\Stream\Application\Dto\ChatMemberDto;
use Craft\DDD\Stream\Domain\Entity\ChatMemberEntity;
use Craft\DDD\Stream\Domain\Repository\MemberRepositoryInterface;
use Craft\Dto\BxImageDto;
use Craft\Helper\Criteria;

class ChatMemberService
{

	public function __construct(
		private readonly MemberRepositoryInterface $memberRepository,
		private readonly ImageServiceInterface     $imageService,
	)
	{
	}

	/**
	 * @return array<int, ChatMemberDto>
	 */
	public function findAll(Criteria $criteria = null): array
	{
		$members = $this->memberRepository->findAll($criteria);


		return array_map(function(ChatMemberEntity $member) {

			$avatar = null;
			$_image = $this->imageService->findById($member->getAvatarId());

			if($_image)
			{
				$avatar = new BxImageDto(
					$_image->id,
					$_image->src,
				);
			}

			return new ChatMemberDto(
				$member->getId(),
				$member->getUsername(),
				$avatar
			);
		}, $members);

	}
}