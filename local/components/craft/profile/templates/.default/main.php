<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 */

use Craft\Model\CraftUser;

?>

<div class="profile-section">
	<div class="profile-aside">
		<?php
		DevIncludeFile('aside');
		?>
	</div>
	<div class="profile-body">
		<?php
		if(CraftUser::load()->isDeveloper())
		{
			require_once __DIR__ . '/layer/developer.php';
		} else
		{
			require_once __DIR__ . '/layer/main.php';
		}
		?>

	</div>
</div>
