<?php

namespace Craft\DDD\Claims\Infrastructure\Services;

use Craft\DDD\Claims\Application\Interfaces\EmailSenderInterface;

class EmailSenderService implements EmailSenderInterface
{
	public function send(string $email, string $message): void
	{
		\CEvent::Send(
			'',
			'',
			''
		);
	}
}