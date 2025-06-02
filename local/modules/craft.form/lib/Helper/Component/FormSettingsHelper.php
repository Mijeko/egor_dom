<?php

namespace Craft\Form\Helper\Component;

class FormSettingsHelper
{

	const COMPONENT_PARAM_RESPONSE = 'RESPONSE_TYPE';

	const RESPONSE_JSON = 'json';
	const RESPONSE_HTML = 'html';

	const CAPTCHA_FROM_YANDEX = 'yandex';
	const CAPTCHA_FROM_GOOGLE = 'google';

	public static function getErrorFormats(): array
	{
		return [
			self::RESPONSE_JSON => 'Ответ JSON',
			self::RESPONSE_HTML => 'Ответ HML',
		];
	}

	public static function getMailEvents(): array
	{
		$events = [];

		$arFilter = [
			"LID" => LANG,
		];

		$eventTypeQuery = \CEventType::GetList($arFilter);
		while($eventType = $eventTypeQuery->Fetch())
		{
			$events[$eventType['EVENT_NAME']] = sprintf('[%s] %s', $eventType['EVENT_NAME'], $eventType['NAME']);
		}

		return $events;
	}

	public static function getMailMessages(string $mailEvent): array
	{
		$messages [0] = 'Отправить все';
		$filter = [
			'EVENT_NAME' => $mailEvent,
			'ACTIVE'     => 'Y',
		];

		$rsMess = \CEventMessage::GetList(
			$by = "id",
			$order = "asc",
			$filter
		);
		while($message = $rsMess->GetNext())
		{
			$messages[$message['ID']] = sprintf('[%s] %s', $message['ID'], $message['SUBJECT']);
		}

		return $messages;
	}

	public static function captchaList(): array
	{
		return [
			self::CAPTCHA_FROM_YANDEX => 'Яндекс капча',
			self::CAPTCHA_FROM_GOOGLE => 'Google капча',
		];
	}
}