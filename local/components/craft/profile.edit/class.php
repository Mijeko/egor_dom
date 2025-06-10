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
				$user->getName(),
				$user->getLastName(),
				$user->getSecondName(),
				$user->getUfCorrAcc(),
				$user->getUfInn(),
			);

			$this->includeComponentTemplate();
		} catch(Exception $exception)
		{

		}
	}

}