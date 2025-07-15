<?php

if(empty($_SERVER['DOCUMENT_ROOT']))
{
	$_SERVER['DOCUMENT_ROOT'] = dirname(dirname(dirname(dirname(__FILE__))));
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");


$service = \Craft\DDD\Developers\Infrastructure\Service\Factory\ImportServiceFactory::getService();
$service->executeAll();

