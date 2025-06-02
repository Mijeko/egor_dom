<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

/**
 * @global CMain $APPLICATION
 */


if(!\Bitrix\Main\Loader::includeModule('craft.core'))
{
	return;
}

if(!empty($_REQUEST['sign_component_params']))
{
	$componentParams = \Craft\Core\Component\Helper\AjaxComponentHelper::unsignData(
		$_REQUEST['sign_component_params'],
		'C6v8b7u8nim'
	);
	if(isset($componentParams['template']) && isset($componentParams['arParams']))
	{

		$componentParams = \Craft\Core\Component\Helper\AjaxComponentHelper::htmlspecialcharsbxArray($componentParams);
		$APPLICATION->IncludeComponent(
			"craft:form",
			$componentParams['template'],
			$componentParams['arParams'],
			false,
			['HIDE_ICONS' => 'Y']
		);
	}
}