<?php

namespace Craft\Slider\IBlockProperties;

use Bitrix\Main\Diag\Debug;
use Craft\Slider\Params\SizeSpecification;
use Craft\Slider\Admin\Html\AdaptiveHtml;

class SliderProperty
{

	public static function getTypeDescription()
	{
		return [
			'PROPERTY_TYPE'        => 'S',
			'USER_TYPE'            => 'JEDI_SLIDER_PROPERTY',
			'DESCRIPTION'          => '[craft] Адаптивный слайдер',
			'GetPropertyFieldHtml' => [__CLASS__, 'GetPropertyFieldHtml'],
			'GetSettingsHTML'      => [__CLASS__, 'GetSettingsHTML'],
			'PrepareSettings'      => [__CLASS__, 'PrepareSettings'],
			'ConvertToDB'          => [__CLASS__, 'ConvertToDB'],
			'ConvertFromDB'        => [__CLASS__, 'ConvertFromDB'],
		];
	}

	public static function GetPropertyFieldHtml($arProperty, $value, $strHTMLControlName)
	{

		\CJSCore::Init([
			'craft.slider.admin',
			'craft.slider.toggle',
		]);

		$source = [];
		if(!empty($value['VALUE']['SOURCE']))
		{
			$source = $value['VALUE']['SOURCE'];
		}

		$adaptiveFiles = [];
		if(!empty($value['VALUE']['ADAPTIVE']))
		{
			$adaptiveFiles = $value['VALUE']['ADAPTIVE'];
		}

		$selectValues = [];
		if(!empty($value['VALUE']['SIZE']) && is_array($value['VALUE']['SIZE']))
		{
			$selectValues = $value['VALUE']['SIZE'];
		}

		ob_start();
		?>


		<div class="adm-adaptive-container">
			<div class="adm-adaptive-slide skip-bbox">
				<?=AdaptiveHtml::fileInputTemplate($strHTMLControlName['VALUE'] . '[SOURCE]', $source['ID'] ?? null);?>
			</div>

			<div class="adm-adaptive-list" data-adm-adaptive-list>
				<?php
				foreach($adaptiveFiles as $index => $file)
				{
					echo AdaptiveHtml::renderAdaptiveItem(
						$strHTMLControlName['VALUE'] . '[' . AdaptiveHtml::KEY_ADAPTIVE . '][' . $index . ']',
						$file['ID'] ?? null,
						[
							'name'   => $strHTMLControlName['VALUE'] . '[' . AdaptiveHtml::KEY_SIZE . '][' . $index . '][]',
							'values' => $selectValues,
						],
						$file['SRC'],
						$index
					);
				}
				?>
			</div>

			<div class="adm-adaptive-control">
				<button
					data-adm-adaptive-create
					class="adm-adaptive-create"
					type="button">Добавить
				</button>
			</div>
		</div>


		<?php

		$jsParams = [
			'ajaxPath'      => '/local/modules/craft.slider/tool/ajax.php',
			'controlName'   => $strHTMLControlName['VALUE'],
			'specification' => SizeSpecification::specification(),
		];
		?>

		<script>
            BX.ready(function () {
                new JediSpecification(<?=json_encode($jsParams);?>);
            });

            $('[data-dev-toggle]').devToggle({
                events: {
                    afterShow: function (instance) {
                        $('[data-dev-toggle-switch]').each(function (_, el) {
                            let $this = $(el);
                            let $targets = $('[data-dev-toggle-target]');
                            if (!$this.is(':checked')) {
                                $($targets[_]).find('input, select, textarea').each(function (_, el) {
                                    $(el).val('');
                                });
                            }
                        });
                    }
                }
            });
		</script>

		<?php
		return ob_get_clean();
	}

	public static function GetSettingsHTML($arProperty, $strHTMLControlName, &$arPropertyFields)
	{
		$arPropertyFields = [
			"HIDE" => ["FILTRABLE", "ROW_COUNT", "COL_COUNT", 'DEFAULT_VALUE'],
		];

		$value = '';
		if($arProperty['USER_TYPE_SETTINGS']['VALUE'])
		{
			$value = $arProperty['USER_TYPE_SETTINGS']['VALUE'];
		}

		return '<tr>
		<td>Текст подсказки:</td>
		<td>
			<textarea 
					cols="55" 
					rows="10" 
					name="' . $strHTMLControlName["NAME"] . '[VALUE]" 
					placeholder="Текст подсказки"
					>' . $value . '</textarea>
		</td>
		</tr>';
	}

	public static function PrepareSettings($arFields)
	{
		$fields = [];
		if(isset($arFields['USER_TYPE_SETTINGS']) && is_array($arFields['USER_TYPE_SETTINGS']))
		{
			$fields = $arFields['USER_TYPE_SETTINGS'];
		}

		return [
			'VALUE' => $fields['VALUE'],
		];
	}

	public static function ConvertToDB($arProperty, $value)
	{
		if(empty($value['VALUE']))
		{
			return false;
		}

		$oldValue = $value['VALUE'];
		$source = $oldValue['SOURCE'];
		$adaptive = $oldValue['ADAPTIVE'];
		$size = $oldValue['SIZE'];

		if(is_array($value['VALUE']['SOURCE']))
		{
			$rawFile = \CIBlock::makeFileArray($value['VALUE']['SOURCE']);
			if($rawFile)
			{
				$fileId = \CFile::SaveFile($rawFile, 'craft.slider/source');
				if($fileId)
				{
					$source = $fileId;
				}
			}
		}


		if(is_array($value['VALUE']['ADAPTIVE']))
		{
			foreach($value['VALUE']['ADAPTIVE'] as $_file)
			{
				if(!is_array($_file))
				{
					continue;
				}

				$rawFile = \CIBlock::makeFileArray($_file);
				if($rawFile)
				{
					$fileId = \CFile::SaveFile($rawFile, 'craft.slider/adaptive');
					if($fileId)
					{
						$adaptive[] = $fileId;
					}
				}
			}
		}

		$sizeResult = [];
		if(!empty($value['VALUE']['SIZE']) && is_array($value['VALUE']['SIZE']))
		{
			foreach($value['VALUE']['SIZE'] as $slideIndex => $slideSizes)
			{
				foreach($slideSizes as $sizeIndex => $sizeData)
				{
					if($sizeIndex == 0)
					{
						if($sizeData == SizeSpecification::TYPE_BY_TEMPLATE_TABLET)
						{
							$sizeResult[$slideIndex]['template'] = SizeSpecification::TYPE_BY_TEMPLATE_TABLET;
							$sizeResult[$slideIndex]['rule'] = 'max-width';
							$sizeResult[$slideIndex]['value'] = 640;
							break;
						}
						if($sizeData == SizeSpecification::TYPE_BY_TEMPLATE_MOBILE)
						{
							$sizeResult[$slideIndex]['template'] = SizeSpecification::TYPE_BY_TEMPLATE_MOBILE;
							$sizeResult[$slideIndex]['rule'] = 'max-width';
							$sizeResult[$slideIndex]['value'] = 640;
							break;
						}
					}

					if($sizeIndex == 1)
					{
						$sizeResult[$slideIndex]['rule'] = $sizeData;
						$sizeResult[$slideIndex]['value'] = intval($slideSizes[2]) ?? null;
						break;
					}
				}
			}
		}

		if($sizeResult)
		{
			$size = $sizeResult;
		}

		return [
			'VALUE'       => serialize([
				'SOURCE'   => $source,
				'ADAPTIVE' => $adaptive,
				'SIZE'     => $size,
			]),
			'DESCRIPTION' => '',
		];
	}

	public static function ConvertFromDB($arProperty, $value, $format = '')
	{
		$value['VALUE'] = unserialize($value['VALUE']);

		$sourceFileId = $value['VALUE']['SOURCE'];
		if($sourceFileId)
		{
			$file = \CFile::GetFileArray($sourceFileId);
			if($file)
			{
				$value['VALUE']['SOURCE'] = $file;
			}
		}

		if(!empty($value['VALUE']['ADAPTIVE']) && is_array($value['VALUE']['ADAPTIVE']))
		{
			$_files = [];
			foreach($value['VALUE']['ADAPTIVE'] as $fileId)
			{
				$file = \CFile::GetFileArray($fileId);
				if($file)
				{
					$_files[] = $file;
				}
			}

			$value['VALUE']['ADAPTIVE'] = $_files;
		}

		return $value;
	}
}