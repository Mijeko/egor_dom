<?php

namespace Craft\DDD\Claims\Infrastructure;

use Craft\DDD\Claims\Application\Interfaces\TgNotifyInterface;

class TgNotifyService implements TgNotifyInterface
{
	public function notify(string $message): void
	{
		try
		{

			$bot = new \TelegramBot\Api\BotApi('5024224686:AAGBe1jd1TMRG3fDn7h3_ZSHRLk0-WWS9N0');
			$bot->sendMessage(378936196, $message);
		} catch(\TypeError $error)
		{
		} catch(\Error $error)
		{
		}
	}
}