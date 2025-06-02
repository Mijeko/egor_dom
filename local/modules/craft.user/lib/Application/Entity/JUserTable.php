<?php

namespace Craft\User\Application\Entity;

use Bitrix\Main\UserTable;

class JUserTable extends UserTable
{

	const F_ID = 'ID';
	const F_EMAIL = 'EMAIL';
	const F_PHONE = 'PERSONAL_PHONE';


	/**
	 * @return array<string,object>
	 */
	public static function getMap(): array
	{
		/* @phpstan-ignore class.noParent */
		$map = parent::getMap();
		return array_merge($map, []);
	}

	public static function getObjectClass(): string
	{
		return JUser::class;
	}

	public static function getCollectionClass(): string
	{
		return JUserCollection::class;
	}
}