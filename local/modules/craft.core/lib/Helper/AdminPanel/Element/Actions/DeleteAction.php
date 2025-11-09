<?php

namespace Craft\Core\Helper\AdminPanel\Element\Actions;

use Craft\Core\Helper\AdminPanel\Action;

class DeleteAction extends Action
{

	public static function build(string $action, string $access = 'W'): DeleteAction
	{
		return self::instance(
			'delete',
			false,
			'Удалить',
			$action,
			$access
		);
	}
}