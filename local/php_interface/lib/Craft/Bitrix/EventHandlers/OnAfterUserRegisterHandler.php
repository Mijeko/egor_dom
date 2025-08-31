<?php

namespace Craft\Bitrix\EventHandlers;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Referal\Application\Dto\InsertReferralDto;
use Craft\DDD\Referal\Application\Factory\InsertReferralMemberFactory;

class OnAfterUserRegisterHandler
{
	public static function handle(&$arFields): void
	{
		Debug::dumpToFile(rand());
		try
		{
			$insertReferralMemberUseCase = InsertReferralMemberFactory::getUseCase();

			Debug::dumpToFile($arFields);
			if(!empty($arFields['ID']) && !empty($arFields['PERSONAL_MOBILE']))
			{
				$userId = intval($arFields['ID']);
				$phone = $arFields['PERSONAL_MOBILE'];

				$insertReferralMemberUseCase->execute(new InsertReferralDto($userId, $phone));
			}
		} catch(\Exception $e)
		{
		}

	}

}