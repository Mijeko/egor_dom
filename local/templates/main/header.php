<?php
/**
 * @global CMain $APPLICATION
 */
?>
<!doctype html>
<html lang="<?=LANGUAGE_ID;?>">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title><?php $APPLICATION->ShowTitle(); ?></title>


	<?php

	$assets = \Bitrix\Main\Page\Asset::getInstance();
	#$assets->addCss(SITE_TEMPLATE_PATH.'/css/main.css');
	#$assets->addJs(SITE_TEMPLATE_PATH.'/js/bundle.js');


	//	$assets->addJs('/local/markup/dom-egor/dist/my-lib-main.umd.js');
	//	$assets->addJs('/local/markup/dom-egor/dist/my-lib-main.es.js');
	//	$assets->addJs('/local/markup/dom-egor/dist/main-Dr_dCjtU.js');
	//	$assets->addJs('/local/markup/dom-egor/dist/HelloWorld-bfuCe-r0.js');
	//	$assets->addCss('/local/markup/dom-egor/dist/my-lib-style.css');

	$APPLICATION->ShowHead();
	?>
</head>
<body>

<div id="panel">
	<?php $APPLICATION->ShowPanel(); ?>
</div>