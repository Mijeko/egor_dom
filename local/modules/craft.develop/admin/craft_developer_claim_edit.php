<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");

/**
 * @global CMain $APPLICATION
 */


use Bitrix\Main\Loader;
use Bitrix\Main\Application;
use Craft\DDD\Claims\Infrastructure\Entity\ClaimTable;

foreach(['craft.develop'] as $module)
{
	if(!Loader::includeModule($module))
	{
		$APPLICATION->ThrowException('Не подключен модуль ' . $module);
	};
}

$request = Application::getInstance()->getContext()->getRequest();
$ID = $request->get('ID') ?? $request->getPost('ID');
if(!$ID)
{
	LocalRedirect(CRAFT_DEVELOP_ADMIN_URL_LIST_CLAIMS);
}

$claimModel = \Craft\DDD\Claims\Infrastructure\Entity\ClaimTable::getById($ID)->fetchObject();
if($request->isPost())
{
	$postData = $request->getPostList()->toArray();
	foreach($postData as $name => $value)
	{
		try
		{
			$claimModel->set($name, $value);
		} catch(Exception $e)
		{
		}
	}


	$result = $claimModel->save();

	if(!$result->isSuccess())
	{
		\Bitrix\Main\Diag\Debug::dumpToFile($result->getErrorMessages());
	}

	$_GET['ID'] = $claimModel->getId();
	LocalRedirect($APPLICATION->GetCurPage() . "?" . http_build_query($_GET));
}

$APPLICATION->SetTitle("Заявка: " . $claimModel->getName());

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");
$aTabs = [
	[
		"DIV"   => "edit1",
		"TAB"   => 'Основная информация',
		"ICON"  => "iblock_section",
		"TITLE" => $claimModel->getName(),
	],
	[
		"DIV"   => "edit2",
		"TAB"   => 'Информация о покупателе',
		"ICON"  => "iblock_section",
		"TITLE" => 'Информация о покупателе',
	],
];


$tabControl = new CAdminForm('craftDeveloperEditTabControl', $aTabs);
$tabControl->BeginEpilogContent();
?>
<?=bitrix_sessid_post()?>
<?php
if($ID)
{
	?>
	<input type="hidden" name="ID" value=<?=$ID?>>
	<?php
}
$tabControl->EndEpilogContent();
$tabControl->Begin();

$tabControl->BeginNextFormTab();

$entity = ClaimTable::getEntity();


if($field = $entity->getField(ClaimTable::F_ID))
{
	$tabControl->BeginCustomField(ClaimTable::F_ID, ClaimTable::F_ID . rand());
	?>
	<tr>
		<td>№ заявки</td>
		<td><?=$claimModel->getId();?></td>
	</tr>
	<?php
	$tabControl->EndCustomField(ClaimTable::F_ID);
}


if($field = $entity->getField(ClaimTable::F_NAME))
{
	$tabControl->BeginCustomField(ClaimTable::F_NAME, ClaimTable::F_NAME . rand());
	?>
	<tr>
		<td></td>
		<td><?=$claimModel->getName();?></td>
	</tr>
	<?php
	$tabControl->EndCustomField(ClaimTable::F_NAME);
}
if($field = $entity->getField(ClaimTable::F_STATUS))
{
	$tabControl->AddDropDownField(
		$field->getName(),
		$field->getTitle(),
		$field->isRequired(),
		(function() {
			$svo = new \Craft\DDD\Claims\Domain\ValueObject\StatusValueObject(null);
			return array_merge([null => 'Статус заявки'], $svo->getStatusList());
		})(),
		$claimModel->getStatus(),
	);
}

$apartment = $claimModel->fillApartment();
if($field = $entity->getField(ClaimTable::F_APARTMENT_ID) && $apartment)
{


	$tabControl->BeginCustomField(ClaimTable::F_APARTMENT_ID, ClaimTable::F_APARTMENT_ID . rand());
	?>
	<tr>
		<td>Объект</td>
		<td><?=$apartment->getName();?></td>
	</tr>
	<tr>
		<td>Цена</td>
		<td><?=$apartment->getPrice();?></td>
	</tr>
	<?php
	$tabControl->EndCustomField(ClaimTable::F_APARTMENT_ID);
}


$tabControl->BeginNextFormTab();
if($field = $entity->getField(ClaimTable::F_CLIENT))
{
	$tabControl->BeginCustomField(ClaimTable::F_CLIENT, ClaimTable::F_CLIENT . rand());
	?>
	<tr>
		<td>ФИО клиента</td>
		<td><?=$claimModel->getClient();?></td>
	</tr>
	<?php
	$tabControl->EndCustomField(ClaimTable::F_CLIENT);
}
if($field = $entity->getField(ClaimTable::F_EMAIL))
{
	$tabControl->BeginCustomField(ClaimTable::F_EMAIL, ClaimTable::F_EMAIL . rand());
	?>
	<tr>
		<td>E-Mail</td>
		<td>
			<a href="mailto:<?=$claimModel->getEmail();?>"><?=$claimModel->getEmail();?></a>
		</td>
	</tr>
	<?php
	$tabControl->EndCustomField(ClaimTable::F_EMAIL);
}
if($field = $entity->getField(ClaimTable::F_PHONE))
{
	$tabControl->BeginCustomField(ClaimTable::F_PHONE, ClaimTable::F_PHONE . rand());
	?>
	<tr>
		<td>Телефон</td>
		<td>
			<a href="tel:<?=$claimModel->getPhone();?>"><?=$claimModel->getPhone();?></a>
		</td>
	</tr>
	<?php
	$tabControl->EndCustomField(ClaimTable::F_PHONE);
}
if($field = $entity->getField(ClaimTable::F_INN))
{
	$tabControl->BeginCustomField(ClaimTable::F_INN, ClaimTable::F_INN . rand());
	?>
	<tr>
		<td>ИНН</td>
		<td><?=$claimModel->getInn();?></td>
	</tr>
	<?php
	$tabControl->EndCustomField(ClaimTable::F_INN);
}
if($field = $entity->getField(ClaimTable::F_OGRN))
{
	$tabControl->BeginCustomField(ClaimTable::F_OGRN, ClaimTable::F_OGRN . rand());
	?>
	<tr>
		<td>ОГРН</td>
		<td><?=$claimModel->getOgrn();?></td>
	</tr>
	<?php
	$tabControl->EndCustomField(ClaimTable::F_OGRN);
}
if($field = $entity->getField(ClaimTable::F_KPP))
{
	$tabControl->BeginCustomField(ClaimTable::F_KPP, ClaimTable::F_KPP . rand());
	?>
	<tr>
		<td>КПП</td>
		<td><?=$claimModel->getKpp();?></td>
	</tr>
	<?php
	$tabControl->EndCustomField(ClaimTable::F_KPP);
}
if($field = $entity->getField(ClaimTable::F_BIK))
{
	$tabControl->BeginCustomField(ClaimTable::F_BIK, ClaimTable::F_BIK . rand());
	?>
	<tr>
		<td>БИК</td>
		<td><?=$claimModel->getBik();?></td>
	</tr>
	<?php
	$tabControl->EndCustomField(ClaimTable::F_BIK);
}
if($field = $entity->getField(ClaimTable::F_BIK))
{
	$tabControl->BeginCustomField(ClaimTable::F_BANK_NAME, ClaimTable::F_BANK_NAME . rand());
	?>
	<tr>
		<td>Наименование банка</td>
		<td><?=$claimModel->getBankName();?></td>
	</tr>
	<?php
	$tabControl->EndCustomField(ClaimTable::F_BANK_NAME);
}
if($field = $entity->getField(ClaimTable::F_CURR_ACC))
{
	$tabControl->BeginCustomField(ClaimTable::F_CURR_ACC, ClaimTable::F_CURR_ACC . rand());
	?>
	<tr>
		<td>Рассчетный счет</td>
		<td><?=$claimModel->getCurrAcc();?></td>
	</tr>
	<?php
	$tabControl->EndCustomField(ClaimTable::F_CURR_ACC);
}
if($field = $entity->getField(ClaimTable::F_CORR_ACC))
{
	$tabControl->BeginCustomField(ClaimTable::F_CORR_ACC, ClaimTable::F_CORR_ACC . rand());
	?>
	<tr>
		<td>Корреспондентский счет</td>
		<td><?=$claimModel->getCorrAcc();?></td>
	</tr>
	<?php
	$tabControl->EndCustomField(ClaimTable::F_CORR_ACC);
}
if($field = $entity->getField(ClaimTable::F_LEGAL_ADDRESS))
{
	$tabControl->BeginCustomField(ClaimTable::F_LEGAL_ADDRESS, ClaimTable::F_LEGAL_ADDRESS . rand());
	?>
	<tr>
		<td>Юридический адрес</td>
		<td><?=$claimModel->getLegalAddress();?></td>
	</tr>
	<?php
	$tabControl->EndCustomField(ClaimTable::F_LEGAL_ADDRESS);
}
if($field = $entity->getField(ClaimTable::F_POST_ADDRESS))
{
	$tabControl->BeginCustomField(ClaimTable::F_POST_ADDRESS, ClaimTable::F_POST_ADDRESS . rand());
	?>
	<tr>
		<td>Почтовый адрес</td>
		<td><?=$claimModel->getPostAddress();?></td>
	</tr>
	<?php
	$tabControl->EndCustomField(ClaimTable::F_POST_ADDRESS);
}


$tabControl->Buttons([
	"disabled" => false,
	"back_url" => CRAFT_DEVELOP_ADMIN_URL_LIST_CLAIMS . "?lang=" . LANG,
]);

$tabControl->Show();

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php");
?>