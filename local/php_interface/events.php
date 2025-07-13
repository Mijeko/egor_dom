<?php

use Craft\DDD\City\Infrastructure\Events\OnPageStartHandler;

$eventManager = \Bitrix\Main\EventManager::getInstance();
$eventManager->registerEventHandlerCompatible("module", "event", "module2", "class", "function");

$eventManager->registerEventHandlerCompatible(
	"rest",
	"OnRestServiceBuildDescription",
	"main",
	\Craft\Rest\Handler::class,
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