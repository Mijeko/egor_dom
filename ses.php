<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Craft\DDD\City\Application\Dto\StoreCurrentCityDto;
use Craft\DDD\City\Application\Factory\StoreCurrentCityUseCaseFactory;


global $APPLICATION;

$cityId = \Bitrix\Main\Application::getInstance()->getContext()->getRequest()->getPost('cityId');

$service = StoreCurrentCityUseCaseFactory::getService();
$service->execute(new StoreCurrentCityDto(intval($cityId)));

$APPLICATION->RestartBuffer();
\Craft\Core\Rest\Response::success([
	's' => rand(),
]);


?>
