<?php

use Bitrix\Main\EventManager;
use Craft\Bitrix\EventHandlers\OnAfterUserAddHandler;
use Craft\Bitrix\EventHandlers\OnBeforeUserAddHandler;
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
	'OnBeforeUserAdd',
	[
		OnBeforeUserAddHandler::class,
		'handle',
	]
);

$eventManager->addEventHandler(
	'main',
	'OnAfterUserAdd',
	[
		OnAfterUserAddHandler::class,
		'handle',
	]
);