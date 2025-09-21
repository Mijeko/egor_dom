<?php

namespace Craft\Socket\Handlers;

class ChatHandler implements WsHandlerInterface
{
	public function handle($payload): void
	{
		echo rand();
		// or return ?
	}
}