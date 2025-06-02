<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Dom");
?>


<?php
$assets = \Bitrix\Main\Page\Asset::getInstance();
$assets->addJs('/local/markup/vite/dist/assets/index-CekCjuaJ.js');
$assets->addCss('/local/markup/vite/dist/assets/index-1byZ3dr3.css');
?>

	<div id="app"></div>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>