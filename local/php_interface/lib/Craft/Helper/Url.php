<?php

namespace Craft\Helper;

use Bitrix\Main\Application;

class Url
{
	public static function getFullUrl(): string
	{
		$isHttps = !empty($_SERVER['HTTPS']) && 'off' !== strtolower($_SERVER['HTTPS']);
		$server = Application::getInstance()->getContext()->getServer();

		return sprintf('%s://%s', $isHttps ? 'https' : 'http', $server->getServerName());
	}
}