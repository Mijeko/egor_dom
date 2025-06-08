<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<?php
/**
 * @var array $arResult
 * @var array $arParams
 * @var JediUserRegisterComponent $component
 */

CJSCore::Init([
	'main.toast',
	'craft.user.core',
]);

?>

<?=$component->beginForm([
	'data-register-form' => '',
]);?>

<h1>Регистрация</h1>

<div class="seller-form-row">
	<div class="seller-form-col" data-input="EMAIL">
		<label>E-Mail</label>
		<?=\Craft\Core\Html\Html::build()->input('EMAIL', ['value' => $component->value('EMAIL')]);?>
		<div class="error"><?=$component->error('EMAIL');?></div>
	</div>
</div>
<div class="seller-form-row">
	<div class="seller-form-col" data-input="PHONE">
		<label>Телефон</label>
		<?=\Craft\Core\Html\Html::build()->input('PHONE', ['value' => $component->value('PHONE')]);?>
		<div class="error"><?=$component->error('PHONE');?></div>
	</div>
</div>

<div class="seller-form-row">
	<div class="seller-form-col" data-input="PASSWORD">
		<label>Пароль</label>
		<?=\Craft\Core\Html\Html::build()->password('PASSWORD', ['value' => $component->value('PASSWORD')]);?>
		<div class="error"><?=$component->error('PASSWORD');?></div>
	</div>
</div>

<?=$component->showSocialAuth();?>

<button type="submit">Зарегистрироваться</button>

<?=$component->endForm();?>

<script>
    new CraftRegisterForm();
</script>