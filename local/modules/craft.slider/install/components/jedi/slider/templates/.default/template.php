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
 * @var DevelopRichSlider $component
 */
?>

<?php
CJSCore::Init([
	'slider',
]);
?>


<div class="swiper" data-develop-slier="">
    <div class="swiper-wrapper" data-develop-slier-wrapper></div>
</div>


<script>
    new DevelopSlider(<?=json_encode($arResult['SLIDER'])?>);
</script>