<?
define('NEED_AUTH', true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новый раздел");


\Bitrix\Main\Loader::includeModule("iblock");




\Bitrix\Main\Diag\Debug::dump($props);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>