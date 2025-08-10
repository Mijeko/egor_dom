<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новый раздел");
?>


<?php

//$rep = new \Craft\DDD\Developers\Infrastructure\Repository\OrmBuildObjectRepository();
$rep = new \Craft\DDD\Developers\Infrastructure\Repository\OrmApartmentRepository();

$list = $rep->findAll();

foreach($list as $item)
{
//	\Bitrix\Main\Diag\Debug::dump($item->getLocation());
	\Bitrix\Main\Diag\Debug::dump($item->getArea());
}


?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>