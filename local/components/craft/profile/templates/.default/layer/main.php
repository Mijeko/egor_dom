<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php
use Craft\DDD\Claims\Application\Factory\ShortOrderInfoUseCaseFactory;
use Craft\Model\CraftUser;


/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;
?>

<h1><?php $APPLICATION->ShowTitle(); ?></h1>
<?php

$APPLICATION->IncludeComponent(
	'craft:vite',
	'vite',
	[
		'SOURCE' => 'profile/ProfileShortInfo',
	],
	false,
	['HIDE_ICONS' => 'Y']
);

$APPLICATION->IncludeComponent(
	'craft:vite',
	'vite',
	[
		'SOURCE' => 'profile/PersonalManager',
	],
	false,
	['HIDE_ICONS' => 'Y']
);
?>


<div class="profile-cards">
	<div class="profile-cards-item">
		<?php
		$APPLICATION->IncludeComponent(
			'craft:vite',
			'vite',
			[
				'SOURCE' => 'profile/ProfileOrderCostInfo',
				'PROPS'  => [
					'items' => ShortOrderInfoUseCaseFactory::getUseCase()
						->execute(CraftUser::load()->getId())->items,
				],
			],
			false,
			['HIDE_ICONS' => 'Y']
		);
		?>
	</div>
	<div class="profile-cards-item">
		<?php
		$APPLICATION->IncludeComponent(
			'craft:referral.info',
			'.default',
			[
				'USER_ID' => CraftUser::load()->getId(),
			],
			false,
			['HIDE_ICONS' => 'Y']
		);
		?>
	</div>
	<div class="profile-cards-item">
		<?php
		$APPLICATION->IncludeComponent(
			'craft:object.last.view',
			'.default',
			[
				'USER_ID' => CraftUser::load()->getId(),
			],
			false,
			['HIDE_ICONS' => 'Y']
		);
		?>
	</div>
	<div class="profile-cards-item x12">
		<?php
		$APPLICATION->IncludeComponent(
			'craft:manager.list',
			'.default',
			[],
			false,
			['HIDE_ICONS' => 'Y']
		);
		?>
	</div>
	<div class="profile-cards-item x12">
		<?php
		$APPLICATION->IncludeComponent(
			'craft:agent.list',
			'.default',
			[],
			false,
			['HIDE_ICONS' => 'Y']
		);
		?>
	</div>
	<div class="profile-cards-item x12">
		<?php
		$APPLICATION->IncludeComponent(
			'craft:student.list',
			'.default',
			[],
			false,
			['HIDE_ICONS' => 'Y']
		);
		?>
	</div>
</div>
