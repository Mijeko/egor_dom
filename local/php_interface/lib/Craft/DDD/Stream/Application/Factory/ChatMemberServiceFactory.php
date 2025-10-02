<?php

namespace Craft\DDD\Stream\Application\Factory;

use Craft\DDD\Shared\Infrastructure\Service\ImageService;
use Craft\DDD\Stream\Application\Services\ChatMemberService;
use Craft\DDD\Stream\Infrastructure\Repository\ChatMemberRepository;
use Craft\DDD\User\Infrastructure\Repository\BxUserRepository;

class ChatMemberServiceFactory
{
	public static function getService(): ChatMemberService
	{
		return new ChatMemberService(
			new ChatMemberRepository(),
			new ImageService(),
			new BxUserRepository(),
		);
	}
}