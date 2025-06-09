<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?php
if(empty($arResult))
{
	return;
}
?>


<div class="header-menu">
	<?php
	foreach($arResult as $arItem)
	{
		?>
		<div class="header-menu-item">
			<a class="header-menu-item__link" href="<?=$arItem['LINK'];?>"><?=$arItem['TEXT'];?></a>
		</div>
		<?php
	}
	?>


</div>
