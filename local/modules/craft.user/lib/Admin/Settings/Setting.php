<?php

namespace Craft\User\Admin\Settings;

abstract class Setting implements SettingInterface
{
	public function getModule(): string
	{
		return 'craft.user';
	}

	public function save($value): void
	{
		if(is_array($value))
		{
			$value = json_encode($value);
		}

		\COption::SetOptionString($this->getModule(), $this->name(), $value);
	}


	public function value()
	{
		$_value = \COption::GetOptionString($this->getModule(), $this->name());

		$value = json_decode($_value, true);
		if(json_last_error() !== JSON_ERROR_NONE)
		{
			$value = $_value;
		}

		return $value;
	}
}