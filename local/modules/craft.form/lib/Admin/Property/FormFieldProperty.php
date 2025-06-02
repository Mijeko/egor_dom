<?php

namespace Craft\Form\Admin\Property;

use Craft\Form\Admin\Helper\FormFieldHelper;

class FormFieldProperty
{
	public static function getTypeDescription()
	{
		return [
			'PROPERTY_TYPE'        => 'S',
			'USER_TYPE'            => FormFieldHelper::USER_TYPE,
			'DESCRIPTION'          => '[craft] Поле формы',
			'GetPropertyFieldHtml' => [__CLASS__, 'GetPropertyFieldHtml'],
			'GetSettingsHTML'      => [__CLASS__, 'GetSettingsHTML'],
			'PrepareSettings'      => [__CLASS__, 'PrepareSettings'],
			'ConvertToDB'          => [__CLASS__, 'ConvertToDB'],
			'ConvertFromDB'        => [__CLASS__, 'ConvertFromDB'],
		];
	}

	public static function GetPropertyFieldHtml($arProperty, $value, $strHTMLControlName)
	{
		$defaultUserSettings = $arProperty['USER_TYPE_SETTINGS'] ?? [];
		$typeField = $defaultUserSettings['TYPE_FIELD'] ?? null;

		$formFieldName = $strHTMLControlName['VALUE'];
		$formFieldCurrentValue = $value['VALUE'];

		switch($typeField)
		{
			case FormFieldHelper::TYPE_FIELD_INPUT:
				ob_start();
				?>

				<input type="text"
					   name="<?=$formFieldName;?>"
					   value="<?=$formFieldCurrentValue;?>"
				>

				<?php
				return ob_get_clean();

			case FormFieldHelper::TYPE_FIELD_TEXTAREA:
				ob_start();
				?>
				<textarea name="<?=$formFieldName;?>"><?=$formFieldCurrentValue;?></textarea>
				<?php
				return ob_get_clean();

			case FormFieldHelper::TYPE_FIELD_SELECT:
				ob_start();
				?>
				<select name="<?=$formFieldName;?>"></select>
				<?php
				return ob_get_clean();
		}
	}

	public static function GetSettingsHTML($arProperty, $strHTMLControlName, &$arPropertyFields)
	{
		$arPropertyFields = [
			"HIDE" => ["FILTRABLE", "ROW_COUNT", "COL_COUNT", 'DEFAULT_VALUE'],
		];

		$defaultParams = $arProperty['USER_TYPE_SETTINGS'];

		$renderOptions = function(array $optionList, $selectedValue = null) {
			ob_start();

			?>
			<option>Выбрать значение</option>
			<?php

			foreach($optionList as $value => $label)
			{
				if(is_array($selectedValue))
				{
					$selected = in_array($value, $selectedValue);
				} else
				{
					$selected = $value == $selectedValue;
				}

				?>
				<option
					<?=$selected ? 'selected' : '';?>
					value="<?=$value;?>"
				>
					<?=$label;?>
				</option>
				<?php
			}

			return ob_get_clean();
		};

		return '<tr>
		<td>Тип поля:</td>
		<td>
			<select name="' . $strHTMLControlName["NAME"] . '[TYPE_FIELD]">' . $renderOptions(FormFieldHelper::typeFieldList(), $defaultParams['TYPE_FIELD']) . '</select>
		</td>
		</tr>
		
		<tr>
			<td>Валидация поля:</td>
			<td>
				<select name="' . $strHTMLControlName['NAME'] . '[VALIDATE_RULES][]" multiple>' . $renderOptions(FormFieldHelper::validateRuleList(), $defaultParams['VALIDATE_RULES']) . '</select>
			</td>
		</tr>
		
		<tr>
			<td>Шаблон поля:</td>
			<td>
				<textarea name="' . $strHTMLControlName['NAME'] . '[TEMPLATE]">' . $defaultParams['TEMPLATE'] . '</textarea>
			</td>
		</tr>
		';
	}

	public static function PrepareSettings($arFields)
	{
		$fields = [];
		if(isset($arFields['USER_TYPE_SETTINGS']) && is_array($arFields['USER_TYPE_SETTINGS']))
		{
			$fields = $arFields['USER_TYPE_SETTINGS'];
		}

		return $fields;
	}

	public static function ConvertToDB($arProperty, $value)
	{
		if(empty($value['VALUE']))
		{
			return false;
		}

		$value['VALUE'] = serialize($value['VALUE']);

		return $value;
	}

	public static function ConvertFromDB($arProperty, $value, $format = '')
	{
		$value['VALUE'] = unserialize($value['VALUE']);

		return $value;
	}
}