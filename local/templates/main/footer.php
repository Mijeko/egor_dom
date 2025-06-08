<?php
/**
 * @global CMain $APPLICATION
 */
?>


<?php

if(\Craft\Model\CraftUser::load()?->isAuthorized())
{
	$APPLICATION->IncludeComponent(
		'craft:vite',
		'vite',
		[
			'SOURCE' => 'BottomFloatMenu',
		],
		false,
		['HIDE_ICONS' => 'Y']
	);
}
?>


</body>
</html>