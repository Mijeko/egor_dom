<?php

namespace Craft\Socket\Handlers;

interface WsHandlerInterface
{
	public function handle($payload): void;
}