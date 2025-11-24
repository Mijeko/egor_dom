<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

/**
 * @global CMain $APPLICATION
 */


use Craft\DDD\Developers\Infrastructure\Entity\BuildObjectTable;
use Craft\DDD\Developers\Infrastructure\Entity\DeveloperTable;

if(empty($_REQUEST['ELEMENT_ID']))
{
	LocalRedirect('/developers/');
}

global $APPLICATION;

$developer = DeveloperTable::getByPrimary($_REQUEST['ELEMENT_ID'])->fetchObject();

if(!$developer->getId())
{
	LocalRedirect('/developers/');
}


$APPLICATION->SetTitle('Строительные объекты компании: ' . $developer->getName());
$APPLICATION->AddChainItem('Строительные объекты компании: ' . $developer->getName(), $APPLICATION->GetCurPage());

inertia('developer/detail');