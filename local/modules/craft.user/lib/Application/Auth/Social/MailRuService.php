<?php

namespace Craft\User\Application\Auth\Social;

final class MailRuService implements SocialAuthServiceInterface
{
	public function getRegisterLink(): string
	{
		return '';
	}

	public function label(): string
	{
		return 'MailRu';
	}
}