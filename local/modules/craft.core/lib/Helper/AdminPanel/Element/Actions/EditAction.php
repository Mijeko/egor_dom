<?php

namespace Craft\Core\Helper\AdminPanel\Element\Actions;

use Craft\Core\Helper\AdminPanel\Action;

class EditAction extends Action
{
	public static function build(string $action): EditAction
	{
		return self::instance(
			'edit',
			true,
			'Изменить',
			$action,
		);
	}

}