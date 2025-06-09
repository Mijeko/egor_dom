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

	$APPLICATION->ShowHead();
	?>
</head>
<body>

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


<h1><?php $APPLICATION->ShowTitle(); ?></h1>