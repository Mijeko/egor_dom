<?php

namespace Craft\DDD\Stream\Application\Dto;

class ChatMessageDto
{
	public function __construct(
		public int    $id,
		public int    $chatId,
		public string $text,
	)
	{
	}
}