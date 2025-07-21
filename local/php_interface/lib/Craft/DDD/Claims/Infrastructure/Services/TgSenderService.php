<?php

namespace Craft\DDD\Claims\Infrastructure\Services;

use Craft\DDD\Claims\Application\Interfaces\TgSenderInterface;

class TgSenderService implements TgSenderInterface
{
	public function send(string $tgUserId, string $message): void
	{
		try
		{
			$bot = new \TelegramBot\Api\BotApi('5024224686:AAGBe1jd1TMRG3fDn7h3_ZSHRLk0-WWS9N0');
			$bot->sendMessage($tgUserId, $message);
		} catch(\TypeError $error)
		{
		} catch(\Error $error)
		{
		}
	}
}