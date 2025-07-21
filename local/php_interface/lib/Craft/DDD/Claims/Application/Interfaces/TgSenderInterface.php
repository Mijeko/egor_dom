<?php

namespace Craft\DDD\Claims\Application\Interfaces;

interface TgSenderInterface
{
	public function send(string $tgUserId, string $message): void;
}