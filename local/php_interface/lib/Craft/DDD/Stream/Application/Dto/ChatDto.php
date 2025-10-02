<?php

namespace Craft\DDD\Stream\Application\Dto;

class ChatDto
{
	public function __construct(
		public int    $id,
		public array  $messages = [],
		public ?array $members = [],
	)
	{
	}
}