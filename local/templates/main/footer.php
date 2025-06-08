<?php
/**
 * @global CMain $APPLICATION
 */
?>


<?php

if($USER->IsAuthorized())
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