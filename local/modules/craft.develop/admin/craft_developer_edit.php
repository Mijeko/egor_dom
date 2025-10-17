<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");

/**
 * @global CMain $APPLICATION
 */

$APPLICATION->SetTitle("Застройщики");

use Bitrix\Main\Loader;
use Bitrix\Main\Application;
use Craft\DDD\City\Infrastructure\Entity\CityTable;
use Craft\DDD\Developers\Infrastructure\Entity\DeveloperTable;
use Bitrix\Main\Page\Asset;
use Craft\DDD\Developers\Infrastructure\Repository\OrmDeveloperRepository;

foreach(['craft.develop'] as $module)
{
	if(!Loader::includeModule($module))
	{
		$APPLICATION->ThrowException('Не подключен модуль ' . $module);
	}
}

Asset::getInstance()->addJs('/bitrix/js/iblock/iblock_edit.js');

$repo = new OrmDeveloperRepository();

$request = Application::getInstance()->getContext()->getRequest();
$ID = $request->get('ID');
$developerModel = $ID ? $repo->findById($ID) : null;

if(!$developerModel)
{
	return;
}

if($request->isPost())
{
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");
$aTabs = [
	[
		"DIV"   => "edit1",
		"TAB"   => 'Застройщик',
		"ICON"  => "iblock_section",
		"TITLE" => $developerModel ? 'Изменить: ' . $developerModel->getName() : 'Новый застройщик',
	],
	[
		"DIV"   => "edit2",
		"TAB"   => 'Настройки',
		"ICON"  => "iblock_section",
		"TITLE" => 'Настройки',
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

$entity = DeveloperTable::getEntity();

if($field = $entity->getField(DeveloperTable::F_ACTIVE))
{
	$tabControl->AddCheckBoxField(
		$field->getName(),
		$field->getTitle(),
		$field->isRequired(),
		[DeveloperTable::ACTIVE_Y, DeveloperTable::ACTIVE_N],
		!$developerModel || $developerModel->getActive()->getValue()
	);
}

if($field = $entity->getField(DeveloperTable::F_NAME))
{
	$tabControl->AddEditField(
		$field->getName(),
		$field->getTitle(),
		$field->isRequired(),
		["size" => 35, "maxlength" => 255],
		$developerModel?->getName()
	);
}

if($field = $entity->getField(DeveloperTable::F_CITY_ID))
{
	$tabControl->AddDropDownField(
		$field->getName(),
		$field->getTitle(),
		$field->isRequired(),
		(function() {
			$res = [];

			$res[] = 'Выбрать город';
			foreach(CityTable::getList()->fetchCollection() as $city)
			{
				$res[$city->getId()] = $city->getName();
			}

			return $res;
		})(),
		$developerModel?->getCityId()
	);
}

if($field = $entity->getField(DeveloperTable::F_SORT))
{
	$tabControl->AddEditField(
		$field->getName(),
		$field->getTitle(),
		$field->isRequired(),
		["size" => 35, "maxlength" => 255],
		$developerModel ? $developerModel->getSort() : 500
	);
}

if($field = $entity->getField(DeveloperTable::F_PICTURE_ID))
{
	$tabControl->AddFileField(
		$field->getName(),
		$field->getTitle(),
		$developerModel?->getPictureId()
	);
}


$tabControl->BeginNextFormTab();

$tabControl->AddEditField(
	'linkSo',
	'linkSo',
	false,
	[

	]
);

//$tabControl->AddDropDownField(
//	'xmlHandler',
//	'Обработчик',
//	false,
//	array_merge(
//		[null => 'Выберите обработчик'],
//		Developer::getImportHandlers()
//	),
//	$developerModel->importSettings()->getHandler()
//);

//$tabControl->BeginCustomField('linkSource', 'asd');
//?>
	<!--	<tr>-->
	<!--		<td></td>-->
	<!--		<td>-->
	<!--			<table id="multiLinkSource">-->
	<!---->
	<!--				--><?php
//				foreach($developerModel->importSettings()->getLinkSource() as $link)
//				{
//					?>
	<!--					<tr>-->
	<!--						<td>-->
	<!--							<input name="linkSource[]" type="text" value="--><?php //=$link;?><!--">-->
	<!--						</td>-->
	<!---->
	<!--					</tr>-->
	<!--					--><?php
//				}
//				?>
	<!---->
	<!--				<tr>-->
	<!--					<td>-->
	<!--						<input name="linkSource[]" type="text" value="">-->
	<!--					</td>-->
	<!---->
	<!--				</tr>-->
	<!---->
	<!--				<tr>-->
	<!--					<td>-->
	<!--						<input type="button" value="Добавить еще" onClick="BX.IBlock.Tools.addNewRow('multiLinkSource')">-->
	<!--					</td>-->
	<!--				</tr>-->
	<!--			</table>-->
	<!--		</td>-->
	<!--	</tr>-->
	<!---->
<?php
//$tabControl->EndCustomField('linkSource');

$tabControl->Buttons([
	"disabled" => false,
	"back_url" => CRAFT_DEVELOP_ADMIN_URL_LIST_DEVELOPERS . "?lang=" . LANG,
]);

$tabControl->Show();