<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

global $APPLICATION;

/**
 * @var array $arResult
 * @var array $arParams
 * @global CMain $APPLICATION
 */

$orderId = $arResult['VARIABLES']['ORDER_ID'];
?>

<div class="profile-section">
	<div class="profile-aside">
		<?php
		DevIncludeFile('aside');
		?>
	</div>
	<div class="profile-body">
		<h1><?php $APPLICATION->ShowTitle(); ?></h1>

		<?php
		$APPLICATION->IncludeComponent(
			'craft:claims.detail',
			'.default',
			[
				'ID' => $orderId,
			],
			false,
			['HIDE_ICONS' => 'Y']
		);
		?>
	</div>
</div>
