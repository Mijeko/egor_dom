<?php

namespace Craft\Bitrix\EventHandlers;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Referal\Application\Dto\InsertReferralDto;
use Craft\DDD\Referal\Application\Factory\InsertReferralMemberFactory;

class OnAfterUserAddHandler
{
	public static function handle(&$arFields): void
	{
		try
		{
			$insertReferralMemberUseCase = InsertReferralMemberFactory::getUseCase();

			if(!empty($arFields['ID']) && !empty($arFields['PERSONAL_MOBILE']))
			{
				$userId = intval($arFields['ID']);
				$phone = $arFields['PERSONAL_MOBILE'];

				$insertReferralMemberUseCase->execute(new InsertReferralDto($userId, $phone));
			}
		} catch(\Exception $e)
		{
			Debug::dumpToFile($e->getMessage());
		}

	}

}