<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");

use Bitrix\Main\Application;
use Craft\DDD\Objects\Infrastructure\Entity\BuildObject;
use Craft\DDD\Objects\Infrastructure\Entity\BuildObjectTable;
use Craft\DDD\Developers\Infrastructure\Entity\DeveloperTable;

/**
 * @global CMain $APPLICATION
 */

$APPLICATION->SetTitle("Управление контентом");


$request = Application::getInstance()->getContext()->getRequest();
$ID = $request->get('ID');
$buildObjectModel = $ID ? BuildObjectTable::getById($ID)->fetchObject() : BuildObjectTable::createObject();
$entity = BuildObjectTable::getEntity();

if($request->isPost())
{
	$filesData = $request->getFileList()->toArray();
	$postData = $request->getPostList()->toArray();

	foreach($postData as $name => $value)
	{
		try
		{
			$buildObjectModel->set($name, $value);
		} catch(Exception $e)
		{
		}
	}

	foreach($filesData as $propertyCode => $fileData)
	{
		switch($propertyCode)
		{
			case BuildObjectTable::F_PICTURE_ID:
				$fileId = \CFile::SaveFile($fileData, BuildObject::UPLOAD_PATH);
				if($fileId)
				{
					$this->set($propertyCode, $fileId);
				}
				break;
		}
	}


	//	костыль
	if($galleryRawData = $_REQUEST[BuildObjectTable::F_GALLERY])
	{
		$buildObjectModel->setGalleryEx($galleryRawData);
	}

	$result = $buildObjectModel->save();

	if(!$result->isSuccess())
	{
		\Bitrix\Main\Diag\Debug::dumpToFile($result->getErrorMessages());
	}

	$_GET['ID'] = $buildObjectModel->getId();
	LocalRedirect($APPLICATION->GetCurPage() . "?" . http_build_query($_GET));
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");

$aTabs = [
	[
		"DIV"   => "edit1",
		"TAB"   => 'Застройщик',
		"ICON"  => "iblock_section",
		"TITLE" => $buildObjectModel ? 'Изменить: ' . $buildObjectModel->getName() : 'Новый застройщик',
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

if($field = $entity->getField(BuildObjectTable::F_ACTIVE))
{
	$tabControl->AddCheckBoxField(
		$field->getName(),
		$field->getTitle(),
		$field->isRequired(),
		[BuildObjectTable::ACTIVE_Y, BuildObjectTable::ACTIVE_N],
		$buildObjectModel ? $buildObjectModel->getActive() : true
	);
}

if($field = $entity->getField(BuildObjectTable::F_NAME))
{
	$tabControl->AddEditField(
		$field->getName(),
		$field->getTitle(),
		$field->isRequired(),
		["size" => 35, "maxlength" => 255],
		$buildObjectModel ? $buildObjectModel->getName() : null
	);
}

if($field = $entity->getField(BuildObjectTable::F_SORT))
{
	$tabControl->AddEditField(
		$field->getName(),
		$field->getTitle(),
		$field->isRequired(),
		["size" => 35, "maxlength" => 255],
		$buildObjectModel ? $buildObjectModel->getSort() : 500
	);
}

if($field = $entity->getField(BuildObjectTable::F_DEVELOPER_ID))
{

	$developers = ["" => 'Выбрать застройщика'];
	$developersCollection = DeveloperTable::getList()->fetchCollection();
	foreach($developersCollection as $developer)
	{
		$developers[$developer->getId()] = $developer->getName();
	}

	$tabControl->AddDropDownField(
		$field->getName(),
		$field->getTitle(),
		$field->isRequired(),
		$developers,
		$buildObjectModel ? $buildObjectModel->getDeveloperId() : null
	);
}

if($field = $entity->getField(BuildObjectTable::F_PICTURE_ID))
{
	$tabControl->AddFileField(
		$field->getName(),
		$field->getTitle(),
		$buildObjectModel?->getPictureId(),
		[],
		$field->isRequired()
	);
}


if($field = $entity->getField(BuildObjectTable::F_GALLERY))
{
	$tabControl->BeginCustomField(
		$field->getName(),
		$field->getTitle(),
	);
	?>
	<tr>
		<td>Галерея</td>
		<td>
			<?php


			$content = $buildObjectModel->getGalleryEx();
			$inputName = [];
			$id = $field->getName() . "[n#IND#]_" . mt_rand(1, 1000000);
			if($content)
			{
				foreach($content as $index => $imageData)
				{
					$inputName[$field->getName() . '[' . $index . ']'] = $imageData;
					$id = $field->getName() . "[" . $index . "]_" . mt_rand(1, 1000000);
				}
			}

			echo \Bitrix\Main\UI\FileInput::createInstance([
				"name"        => $field->getName() . '[n#IND#]',
				"id"          => $id,
				"description" => true,
				"upload"      => true,
				"allowUpload" => "I",
				"medialib"    => true,
				"fileDialog"  => true,
				"cloud"       => true,
				"delete"      => true,
			])->show($inputName);
			?>
		</td>
	</tr>
	<?php
	$tabControl->EndCustomField($field->getName());
}

$tabControl->Buttons([
	"disabled" => false,
	"back_url" => CRAFT_DEVELOP_ADMIN_URL_LIST_OBJECTS . "?lang=" . LANG,
]);

$tabControl->Show();

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php");