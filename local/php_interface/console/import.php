<?php

if(empty($_SERVER['DOCUMENT_ROOT']))
{
	$_SERVER['DOCUMENT_ROOT'] = dirname(dirname(dirname(dirname(__FILE__))));
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");


$developers = \Craft\DDD\Developers\Infrastructure\Entity\DeveloperTable::getList()->fetchCollection();
$service = \Craft\DDD\Developers\Infrastructure\Service\Factory\ImportServiceFactory::getService();

foreach($developers as $developer)
{
	try
	{
		$service->execute($developer->getId());
	} catch(Exception $e)
	{
	}
}

