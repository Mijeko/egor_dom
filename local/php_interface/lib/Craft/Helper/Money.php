<?php

namespace Craft\Helper;

class Money
{
	public static function format($amount, $decimals = 0): string
	{
		return number_format($amount, $decimals, '', ' ');
	}
}