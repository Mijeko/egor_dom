<?php

namespace Craft\DDD\Claims\Application\Interfaces;

interface EmailSenderInterface
{
	public function send(string $email, string $message): void;
}