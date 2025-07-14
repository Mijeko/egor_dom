<?php

use Craft\DDD\City\Infrastructure\Events\OnPageStartHandler;

$eventManager = \Bitrix\Main\EventManager::getInstance();

$eventManager->registerEventHandlerCompatible(
	"rest",
	"OnRestServiceBuildDescription",
	"main",
	\Craft\Rest\Handler::class,
	"onRestServiceBuildDescription"
);

$eventManager->registerEventHandlerCompatible(
	"main",
	"OnProlog",
	"main",
	OnPageStartHandler::class,
	"execute",
	"100"
);