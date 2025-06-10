<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?php
if(empty($arResult))
{
	return;
}
?>

<ul class="left-menu">
	<?php
	foreach($arResult as $arItem)
	{
		if($arItem["SELECTED"])
		{
			?>
			<li>
				<a href="<?=$arItem["LINK"]?>" class="selected"><?=$arItem["TEXT"]?></a>
			</li>
			<?php
		} else
		{
			?>
			<li>
				<a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
			</li>
			<?php
		}
	}
	?>
</ul>
