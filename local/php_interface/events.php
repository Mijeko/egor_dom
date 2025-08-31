<?php

use Bitrix\Main\EventManager;
use Craft\Bitrix\EventHandlers\OnAfterUserRegisterHandler;
use Craft\DDD\City\Infrastructure\Events\OnPageStartHandler;
use Craft\Rest\Handler;

$eventManager = EventManager::getInstance();

$eventManager->registerEventHandlerCompatible(
	"rest",
	"OnRestServiceBuildDescription",
	"main",
	Handler::class,
	"onRestServiceBuildDescription"
);

$eventManager->registerEventHandlerCompatible(
	"main",
	"OnPageStart",
	"main",
	OnPageStartHandler::class,
	"execute",
	"100"
);

$eventManager->addEventHandler(
	'main',
	'OnAfterUserRegister',
	[
		OnAfterUserRegisterHandler::class,
		'handle',
	]
);