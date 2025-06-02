<?php

namespace Craft\Form\Admin\Helper;

class FormFieldHelper
{

	const USER_TYPE = 'JEDI_FORM_FIELD_PROPERTY';

	const VALIDATE_RULE_EMAIL = 'email';
	const VALIDATE_RULE_PHONE = 'phone';


	const TYPE_FIELD_INPUT = 'input';
	const TYPE_FIELD_TEXTAREA = 'textarea';
	const TYPE_FIELD_SELECT = 'select';
	const TYPE_FIELD_FILE = 'file';

	public static function validateRuleList(): array
	{
		return [
			self::VALIDATE_RULE_EMAIL => 'E-mail',
			self::VALIDATE_RULE_PHONE => 'Телефон',
		];
	}

	public static function typeFieldList(): array
	{
		return [
			self::TYPE_FIELD_INPUT    => '[input] Поле ввода',
			self::TYPE_FIELD_TEXTAREA => '[textarea] Широкое поле ввода',
			self::TYPE_FIELD_SELECT   => '[select] Список',
			self::TYPE_FIELD_FILE     => '[file] Файл',
		];
	}
}