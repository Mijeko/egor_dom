<?php
/**
 * @global CMain $APPLICATION
 * @global CUser $USER
 */

use Bitrix\Main\Application;
use Bitrix\Main\Page\Asset;

?>
<!doctype html>
<html lang="<?=LANGUAGE_ID;?>">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title><?php $APPLICATION->ShowTitle(); ?></title>

	<?php
	$assets = Asset::getInstance();


	$assets->addJs(SITE_TEMPLATE_PATH . '/js/bundle.js');
	$assets->addJs("https://api-maps.yandex.ru/v3/?apikey=6ff29c21-740b-42c8-b626-81e1097f38fb&amp;lang=ru_RU");
	$assets->addCss(SITE_TEMPLATE_PATH . '/css/main.css');


	CJSCore::Init([
		'fx',
	]);

	vite()->load();

	$APPLICATION->ShowHead();
	?>
</head>

<body class="page">
<?php
if(!Application::getInstance()->getContext()->getRequest()->get('hp'))
{
	?>

	<div id="panel">
		<?php $APPLICATION->ShowPanel(); ?>
	</div>
	<?php
}
?>
