<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

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
 * @var DevelopFormComponent $component
 */

CJSCore::init([
	'toast',
	'craft.form.core',
]);

?>

<?=$component->beginForm([
	'method'             => 'post',
	'data-feedback-form' => '',
	'enctype'            => 'multipart/form-data',
]);?>
	<p>Тест форма</p>


	<div class="site-form-row">
		<div class="site-form-col">
			<div>
				<?=$component->input('DDD');?>
				<?=$component->error('DDD');?>
			</div>
		</div>
		<div class="site-form-col">

		</div>
	</div>


<?=$component->captcha();?>

	<button type="submit">Отправить</button>
<?=$component->endForm();?>

<?php

$jsParams = [
	'ajaxUrl'  => $componentPath . '/ajax.php',
	'ajaxHead' => $arResult['AJAX_REQUEST_HEAD'],
];


if(!$arResult['IS_AJAX_REQUEST'])
{
	?>
	<script>
        new DevelopForm(<?= json_encode($jsParams); ?>);
	</script>
	<?php
}
?>