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


	$assets->addJs(SITE_TEMPLATE_PATH . '/js/bundle.js');
	$assets->addCss(SITE_TEMPLATE_PATH . '/css/main.css');

	$APPLICATION->ShowHead();
	?>
</head>


<body class="page">
<div id="panel">
	<?php
	if(!\Bitrix\Main\Application::getInstance()->getContext()->getRequest()->get('hp'))
	{
		?>
		<?php $APPLICATION->ShowPanel(); ?>
		<?php
	}
	?>
</div>


<div class="stronger">

	<div class="container">
		<header class="header">
			<div class="logo">
				<a href="/">
					<img class="logo__image" src="<?=SITE_TEMPLATE_PATH;?>/images/logo.png">
				</a>
			</div>

			<div>
				<?php
				$APPLICATION->IncludeComponent(
					"bitrix:menu",
					"header.menu",
					[
						"COMPONENT_TEMPLATE"    => ".default",
						"ROOT_MENU_TYPE"        => "top",
						"MENU_CACHE_TYPE"       => "N",
						"MENU_CACHE_TIME"       => "3600",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"MENU_CACHE_GET_VARS"   => "",
						"MAX_LEVEL"             => "1",
						"CHILD_MENU_TYPE"       => "left",
						"USE_EXT"               => "N",
						"DELAY"                 => "N",
						"ALLOW_MULTI_SELECT"    => "N",
					],
					false,
					['HIDE_ICONS' => 'Y']
				);
				?>
			</div>
		</header>
	</div>

	<div class="page-content">
		<div class="container">
			<h1><?php $APPLICATION->ShowTitle(); ?></h1>