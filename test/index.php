<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новый раздел");
?>
<?php


global $USER, $APPLICATION;

\Bitrix\Main\Diag\Debug::dump($USER);
\Bitrix\Main\Diag\Debug::dump($APPLICATION);
exit();
?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>