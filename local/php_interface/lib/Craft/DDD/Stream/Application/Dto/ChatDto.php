<?php

namespace Craft\DDD\Stream\Application\Dto;

class ChatDto
{
	public function __construct(
		public int           $id,
		public int           $userId,
		public int           $acceptUserId,
		public array         $messages = [],
		public ChatMemberDto $acceptMember,
	)
	{
	}
}