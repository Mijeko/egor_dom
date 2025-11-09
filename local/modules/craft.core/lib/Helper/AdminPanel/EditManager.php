<?php

namespace Craft\Core\Helper\AdminPanel;

class EditManager
{


	public function __construct() { }

	public static function instance(): EditManager
	{
		return new self();
	}

}