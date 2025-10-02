<?php

namespace Craft\DDD\Stream\Application\Dto;

use Craft\Dto\BxImageDto;

class ChatMemberDto
{
	public function __construct(
		public int         $id,
		public int         $chatId,
		public int         $userId,
		public string      $name,
		public ?BxImageDto $avatar = null,
	)
	{
	}
}