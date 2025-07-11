<?php

namespace Craft\DDD\Claims\Application\Interfaces;

interface TgNotifyInterface
{
	public function notify(string $message): void;
}