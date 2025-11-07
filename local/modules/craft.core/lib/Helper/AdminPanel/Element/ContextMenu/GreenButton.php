<?php

namespace Craft\Core\Helper\AdminPanel\Element\ContextMenu;

class GreenButton extends Button
{
	public static function build(
		string $text,
		string $link,
		string $title,
	): GreenButton
	{
		return self::instance(
			$text,
			$link,
			$title,
			'btn_new',
		);
	}
}