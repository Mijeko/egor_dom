<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<?php
/**
 * @global CMain $APPLICATION
 */

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
			'craft:vite',
			'vite',
			[
				'SOURCE' => 'ProfileIndex',
			],
			false,
			['HIDE_ICONS' => 'Y']
		);
		?>
	</div>
</div>
