<?php

use Craft\Slider\Admin\Html\AdaptiveHtml;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");

global $APPLICATION;

if(!\Bitrix\Main\Loader::includeModule('craft.slider'))
{
	return;
};

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

$controlName = $request->getPost('controlName');
$countItem = $request->getPost('countItem');

ob_start();
echo AdaptiveHtml::renderAdaptiveItem(
	$controlName . '[' . AdaptiveHtml::KEY_ADAPTIVE . '][' . $countItem . ']',
	[],
	[
		'name' => $controlName . '[' . AdaptiveHtml::KEY_SIZE . '][' . $countItem . ']',
	],
),

$html = ob_get_clean();


$APPLICATION->RestartBuffer();
header('Content-Type: application/json; charset=utf-8');
echo json_encode(['html' => $html]);

