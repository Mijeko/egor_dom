<?php

namespace Craft\Slider\Admin\Html;

use Craft\Slider\Params\SizeSpecification;

class AdaptiveHtml
{
	const KEY_ADAPTIVE = 'ADAPTIVE';
	const KEY_SIZE = 'SIZE';

	public static function renderAdaptiveItem(string $fileNameControl, $fileParams, array $selectControlData, string $image = null, $index = null): string
	{
		$selectValues = $selectControlData['values'];
		$curVal = [];
		if(!empty($selectValues[$index]))
		{
			$curVal = $selectValues[$index];
		}

		$specificationTemplates = SizeSpecification::specificationTemplates();
		ob_start();
		?>
		<div class="adm-adaptive-item" data-adm-adaptive-item>

			<div class="adm-adaptive-item__header">
				<?php
				if($curVal)
				{
					?>
					<div class="adm-adaptive-item__header-label">
						<?=($curVal && !empty($curVal['template']) ? $specificationTemplates[$curVal['template']] : $curVal['rule'] . ': ' . $curVal['value']);?></div>
					<?php
				}
				?>

				<div class="adm-adaptive-item__header-remove" data-adm-adaptive-item-remove>
					Удалить
				</div>
			</div>
			<div class="adm-adaptive-item__body">
				<div class="adm-adaptive-item__size">
					<form data-size-form>

					</form>
					<div class="size-variant">
						<div class="size-variant-list" data-dev-toggle="advancedSettings">
							<label class="size-variant-item-wrap">
								<input
									class="size-variant-item__input"
									data-dev-toggle-switch
									type="radio"
									name="typeSettings[<?=$index;?>]"
									value="simple"
									<?=($curVal && !empty($curVal['template'])) ? 'checked' : '';?>
								>
								<div class="size-variant-item">
									<span class="size-variant-item__label">Простые настройки</span>
								</div>
							</label>

							<label class="size-variant-item-wrap">
								<input
									class="size-variant-item__input"
									data-dev-toggle-switch
									type="radio"
									name="typeSettings[<?=$index;?>]"
									value="advanced"
									<?=($curVal && empty($curVal['template'])) ? 'checked' : '';?>
								>
								<div class="size-variant-item">
									<span class="size-variant-item__label">Продвинутные настройки</span>
								</div>
							</label>
						</div>
						<div data-dev-toggle-target="advancedSettings">
							<br>
							<hr>
							<br>
							<select name="<?=$selectControlData['name'];?>" style="width: 100%;">
								<?php
								foreach(['' => 'Выбрать значение'] + $specificationTemplates as $_value => $_label)
								{
									$selected = false;
									if($curVal && !empty($curVal['template']))
									{
										$selected = $curVal['template'] == $_value;
									}

									?>
									<option
										<?=$selected ? 'selected' : '';?>
										value="<?=$_value;?>"><?=$_label;?></option>
									<?php
								}
								?>
							</select>
						</div>
						<div data-dev-toggle-target="advancedSettings">
							<br>
							<hr>
							<br>
							<select name="<?=$selectControlData['name'];?>" style="width: 100%;">
								<?php
								foreach(['' => 'Выбрать значение'] + SizeSpecification::specification() as $_value => $_label)
								{
									$selected = false;
									if($curVal && empty($curVal['template']))
									{
										$selected = $curVal['rule'] == $_value;
									}
									?>
									<option
										<?=$selected ? 'selected' : '';?>
										value="<?=$_value;?>"><?=$_label;?></option>
									<?php
								}
								?>
							</select>
							<br>
							<br>
							<input
								name="<?=$selectControlData['name'];?>"
								type='text'
								placeholder="Введите значение. К примеру 991px"
								style="width: 100%;"
								<?=($curVal && empty($curVal['template']) ? 'value="' . $curVal['value'] . '"' : '');?>
							>
						</div>
					</div>
				</div>
				<div class="adm-adaptive-item__image-wrap">
					<?php
					if($image)
					{
						?>
						<img
							class="adm-adaptive-item__image"
							src="<?=$image;?>"
						>
						<?php
					}
					?>

				</div>
				<div class="adm-adaptive-item__load">
					<?=self::fileInputTemplate($fileNameControl, $fileParams);?>
				</div>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}

	public static function fileInputTemplate(string $controlName, $params = null): string
	{
		return \Bitrix\Main\UI\FileInput::createInstance([
			"name"        => $controlName,
			"description" => true,
			"upload"      => true,
			"allowUpload" => "A",
			"medialib"    => true,
			"fileDialog"  => true,
			"cloud"       => true,
			"delete"      => true,
			'maxCount'    => 1,
		])->show($params);
	}
}