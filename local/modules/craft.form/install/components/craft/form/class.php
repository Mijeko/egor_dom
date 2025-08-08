<?php

use Bitrix\Main\Event;
use Bitrix\Main\EventResult;
use Craft\Core\Component\AjaxComponent;
use Craft\Form\Helper\Component\FormSettingsHelper;
use Craft\Core\Exceptions\Component\ValidateException;
use Craft\Core\Exceptions\Component\EventErrorExecption;
use Craft\Core\Exceptions\Component\SaveElementException;

class DevelopFormComponent extends AjaxComponent
{
	protected array $formData = [];

	public function componentNamespace(): string
	{
		return 'craftAjaxForm';
	}


	protected function work(array $formData): void
	{

		$model = new CIBlockElement();
		$elementName = sprintf('Новая заявка с сайта %s', date('d.m.Y H:i:s'));

		$params = [
			'ACTIVE'          => 'Y',
			'NAME'            => $elementName,
			'CODE'            => \CUtil::translit($elementName, LANG),
			'IBLOCK_ID'       => $this->arParams['IBLOCK_ID'],
			'PROPERTY_VALUES' => $formData,
		];

		$event = new Event($this->componentNamespace(), 'modifyElementParams', $params);
		$event->send();
		foreach($event->getResults() as $result)
		{
			switch($result->getType())
			{
				case EventResult::ERROR:
					throw new EventErrorExecption('Event `modifyElementParams` has errors');

				case EventResult::SUCCESS:
					$params = array_merge($params, $result->getParameters());
					break;
			}
		}

		$resultAdd = $model->Add($params);
		if(!$resultAdd)
		{
			throw new SaveElementException($model->LAST_ERROR);
		}



	}

	protected function modules(): ?array
	{
		return ['iblock'];
	}

	protected function loadData(): void
	{
	}

	public function loadServices(): void
	{
	}

	protected function validate(array $postData): void
	{
		$this->arResult['ERRORS'] = [];

		$validateRules = array_map(function($property) {

			$rules = '';

			if($property['IS_REQUIRED'] == 'Y')
			{
				$rules = 'required|';
			}

			if($property['SETTINGS']['VALIDATE_RULES'] && is_array($property['SETTINGS']['VALIDATE_RULES']))
			{
				$rules .= implode('|', $property['SETTINGS']['VALIDATE_RULES']);
			}

			return $rules;

		}, $this->arResult['PROPERTIES'] ?? []);

		foreach($postData as $propertyCode => $value)
		{
			$_rules = $validateRules[$propertyCode] ?? null;
			$rules = [];

			if($_rules)
			{
				$rules = explode('|', $_rules);
			}

			foreach($rules as $rule)
			{
				switch($rule)
				{
					case 'required':
						if(!mb_strlen($value))
						{
							$this->arResult['ERRORS'][$propertyCode] = 'Нужно заполнить поле ' . $this->label($propertyCode);
						}
						break;
					case 'phone':
						break;
				}
			}
		}

		if($this->arResult['ERRORS'])
		{
			throw new ValidateException(implode(PHP_EOL, $this->arResult['ERRORS']));
		}
	}
}