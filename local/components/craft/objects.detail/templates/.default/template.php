<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php
/**
 * @var string $componentPath
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @global CDatabase $DB
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $templateFile
 * @var string $templateFolder
 * @var string $componentPath
 * @var CraftBuildObjectsDetailComponent $component
 *
 * @var \Craft\DDD\Objects\Infrastructure\Dto\BuildObjectDetailDto $element
 */

$element = $arResult['ELEMENT'];

?>

<?php
$APPLICATION->IncludeComponent(
	'craft:vite',
	'vite',
	[
		'SOURCE' => 'ObjectDetail',
		'PROPS'  => [
			'product' => $element,
		],
	],
	false,
	['HIDE_ICONS' => 'Y']
)
?>

