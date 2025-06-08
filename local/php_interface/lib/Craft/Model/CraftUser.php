<?php

namespace Craft\Model;

class CraftUser extends EO_CraftUser
{
	protected static ?CraftUser $instance = null;

	public static function load(?int $id = null): ?static
	{
		if(is_null(static::$instance))
		{

			if(!$id)
			{
				global $USER;
				$id = $USER->GetID();
			}

			$user = CraftUserTable::getByPrimary($id)->fetchObject();
			if(!$user)
			{
				return null;
			}

			/* @var CraftUser $user */

			static::$instance = $user;
		}

		return static::$instance;
	}

	public function IsAuthorized(): bool
	{
		global $USER;
		return $USER->IsAuthorized();
	}
}