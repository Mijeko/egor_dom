<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php
/**
 * @var array $arResult
 * @var array $arParams
 */

$orderId = $arResult['VARIABLES']['ORDER_ID'];

\Bitrix\Main\Diag\Debug::dump($orderId);
?>