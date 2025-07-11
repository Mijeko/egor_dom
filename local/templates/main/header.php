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
	$assets->addJs("https://api-maps.yandex.ru/v3/?apikey=6ff29c21-740b-42c8-b626-81e1097f38fb&amp;lang=ru_RU");
	$assets->addCss(SITE_TEMPLATE_PATH . '/css/main.css');

	$APPLICATION->ShowHead();
	?>
</head>


<?php
$APPLICATION->IncludeComponent(
	'craft:vite',
	'vite',
	[
		'SOURCE' => 'system/Init',
		'PROPS'  => [
			'user' => \Craft\Dto\BxUserDto::fromGlobal(),
		],
	],
	false,
	['HIDE_ICONS' => true]
);
?>


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
		<?php
		if(\Craft\Model\CraftUser::load()?->IsAuthorized())
		{
			DevIncludeFile('header', SITE_TEMPLATE_PATH . '/.include/');
		}
		?>
	</div>

	<div class="page-content">
		<div class="container">

			<?php
			if($APPLICATION->GetCurPage() != '/')
			{
				//				$APPLICATION->IncludeComponent(
				//					"bitrix:breadcrumb",
				//					"breadcrumbs",
				//					[
				//						"COMPONENT_TEMPLATE" => ".default",
				//						"START_FROM"         => "0",
				//						"PATH"               => "",
				//						"SITE_ID"            => "s1",
				//					],
				//					false,
				//					['HIDE_ICONS' => 'Y']
				//				);
			}
			?>

			<?php
			if(!\Craft\Service\SkipPageTitle::skip())
			{
				?>
				<h1><?php $APPLICATION->ShowTitle(); ?></h1>
				<?php
			}
			?>