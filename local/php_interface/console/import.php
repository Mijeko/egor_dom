<?php
if(empty($_SERVER['DOCUMENT_ROOT']))
{
	$_SERVER['DOCUMENT_ROOT'] = dirname(dirname(dirname(dirname(__FILE__))));
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Craft\DDD\Developers\Application\Service\Factory\ImportServiceFactory;

$service = ImportServiceFactory::getService();
$service->executeAll();

