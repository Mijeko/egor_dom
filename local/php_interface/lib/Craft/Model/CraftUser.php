<?php

namespace Craft\Model;

use Bitrix\Main\Diag\Debug;

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

	public function isStudent(): bool
	{
		if(!defined('USER_GROUP_STUDENT_ID'))
		{
			return false;
		}

		$groups = $this->fillGroups()->getGroupIdList();
		return in_array(USER_GROUP_STUDENT_ID, $groups);
	}

	public function isRealtor(): bool
	{
		if(!defined('USER_GROUP_REALTOR_ID'))
		{
			return false;
		}

		$groups = $this->fillGroups()->getGroupIdList();
		return in_array(USER_GROUP_REALTOR_ID, $groups);
	}

	public function getAvatarPath(): ?string
	{
		$file = \CFile::GetFileArray($this->getPersonalPhoto());
		if(!$file)
		{
			return null;
		}

		return $file['SRC'];
	}

	public function getFullName(): string
	{
		return implode(' ', [
			$this->getLastName(),
			$this->getSecondName(),
			$this->getName(),
		]);
	}
}