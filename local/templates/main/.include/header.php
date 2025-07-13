<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;
?>
<header class="header">
	<div class="logo">
		<a href="/">
			<img class="logo__image" src="<?=SITE_TEMPLATE_PATH;?>/images/logo.png">
		</a>
	</div>

	<div>
		<?php
		$APPLICATION->IncludeComponent(
			'craft:city.current',
			'.default',
			[],
			false,
			['HIDE_ICONS' => 'Y']
		);
		?>
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