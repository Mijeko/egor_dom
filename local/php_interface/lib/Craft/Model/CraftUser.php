<?php

namespace Craft\Model;

class CraftUser extends EO_CraftUser
{
	const PERSON_TYPE_PHYS = 'phys';
	const PERSON_TYPE_JUR = 'jur';
	const PERSON_TYPE_IP = 'ip';

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

	public function getPersonType(): ?string
	{
		if($this->isPhysPerson())
		{
			return self::PERSON_TYPE_PHYS;
		}

		if($this->isJurPerson())
		{
			return self::PERSON_TYPE_JUR;
		}

		return null;
	}

	public function isPhysPerson(): bool
	{
		if(!defined('USER_GROUP_PHYS_PERSON_ID'))
		{
			return false;
		}

		$groups = $this->fillGroups()->getGroupIdList();
		return in_array(USER_GROUP_PHYS_PERSON_ID, $groups);
	}

	public function isJurPerson(): bool
	{
		if(!defined('USER_GROUP_JUR_PERSON_ID'))
		{
			return false;
		}

		$groups = $this->fillGroups()->getGroupIdList();
		return in_array(USER_GROUP_JUR_PERSON_ID, $groups);
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
			$this->getName(),
			$this->getSecondName(),
		]);
	}
}