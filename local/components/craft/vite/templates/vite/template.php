<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php
/**
 * @var array $arResult
 * @var array $arParams
 */


if(mb_strlen($arParams['ID']) > 0)
{
	?>
	<div id="<?=$arParams['ID'];?>"></div>
	<script>
        window.vs.render('HelloWorld', '<?=$arParams['ID'];?>');
	</script>
	<?php
}
?>

