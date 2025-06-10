<?php
/**
 * @global CMain $APPLICATION
 */
?>


<?php

if(\Craft\Model\CraftUser::load()?->isAuthorized())
{

	$APPLICATION->IncludeComponent(
		"bitrix:menu",
		"bottom.float.menu",
		[
			"COMPONENT_TEMPLATE"    => ".default",
			"ROOT_MENU_TYPE"        => "bottom_float_menu",
			"MENU_CACHE_TYPE"       => "N",
			"MENU_CACHE_TIME"       => "3600",
			"MENU_CACHE_USE_GROUPS" => "Y",
			"MENU_CACHE_GET_VARS"   => "",
			"MAX_LEVEL"             => "1",
			"CHILD_MENU_TYPE"       => "",
			"USE_EXT"               => "N",
			"DELAY"                 => "N",
			"ALLOW_MULTI_SELECT"    => "N",
		],
		false,
		["HIDE_ICONS" => "Y"]
	);
}
?>

</div>
</div>

<?php
if(\Craft\Model\CraftUser::load()?->IsAuthorized())
{
	DevIncludeFile('footer', SITE_TEMPLATE_PATH . '/.include/');
}

?>

</div>

</body>
</html>