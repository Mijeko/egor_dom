<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;
?>

<h1><?php $APPLICATION->ShowTitle(); ?></h1>

<div class="profile-cards">
	<div class="profile-cards-item">
		<?php
		$APPLICATION->IncludeComponent(
			'craft:developer.feed.load',
			'.default',
			[],
			false,
			['HIDE_ICONS' => 'Y']
		);
		?>
	</div>
</div>