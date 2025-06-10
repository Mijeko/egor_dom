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
		<h1>Заявки</h1>

		<?php
		$APPLICATION->IncludeComponent(
			'craft:claims',
			'.default',
			[
				'USER_ID' => \Craft\Model\CraftUser::load()?->getId(),
			],
			false,
			['HIDE_ICONS' => 'Y']
		);
		?>
	</div>
</div>
