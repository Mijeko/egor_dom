<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php'); ?>
<?php

foreach(['craft.core', 'craft.modal'] as $module)
{
	if(!\Bitrix\Main\Loader::includeModule($module))
	{
		\Craft\Core\Rest\Response::badRequest('Module ' . $module . ' not installed: ');
	}
}

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
if($request->get('craftModal') || $request->getPost('craftModal'))
{
	$template = $request->get('template');

	if(!$template)
	{
		$template = '.default';
	}

	global $APPLICATION;

	$componentParams = [];

	if($request->getPost('message'))
	{
		$componentParams['MESSAGE'] = $request->getPost('message');
	}

	$modalHtml = $APPLICATION->IncludeComponent(
		'craft:modal',
		$template,
		$componentParams,
		false,
		['HIDE_ICONS' => true]
	);

	\Craft\Core\Rest\Response::success([
		'modal' => $modalHtml,
	]);
}
