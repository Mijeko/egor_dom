<?php

use Craft\Dto\ProfileEditUserDataDto;
use Craft\Model\CraftUser;

class CraftProfileEditComponent extends CBitrixComponent
{
	public function onPrepareComponentParams($arParams)
	{
		return $arParams;
	}

	public function executeComponent()
	{

		try
		{
			$user = CraftUser::load();
			if(!$user)
			{
				throw new \Exception("User not found");
			}


			$this->arResult['USER_DATA'] = new ProfileEditUserDataDto(
				$user->getPersonType(),
				$user->getId(),
				$user->fillName(),
				$user->fillLastName(),
				$user->fillSecondName(),
				$user->fillUfCorrAcc(),
				$user->fillUfInn(),
				$user->fillUfOgrn(),
			);

			$this->includeComponentTemplate();
		} catch(Exception $exception)
		{
			echo $exception->getMessage();
		}
	}

}