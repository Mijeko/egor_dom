<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");

/**
 * @global CMain $APPLICATION
 */

use Craft\Translate\Entity\DictionaryTable;
use Bitrix\Main\Loader;

$APPLICATION->SetTitle("Настройки модуля пользователей");


foreach(['craft.translate'] as $module)
{
	if(!Loader::includeModule($module))
	{
		$APPLICATION->ThrowException('Не подключен модуль ' . $module);
	};
}


// вычисления - конец
$res = DictionaryTable::getList([
	'order' => [
		DictionaryTable::FIELD_ID => 'DESC',
	],
]);
$POST_RIGHT = $APPLICATION->GetGroupRight("craft.translate");
$data = new CAdminResult($res, DictionaryTable::getTableName());

// вывод

$lAdmin = new CAdminList(DictionaryTable::getTableName());
$lAdmin->AddHeaders([
	['id' => DictionaryTable::FIELD_ID, 'content' => 'ID', 'default' => true],
	['id' => DictionaryTable::FIELD_INPUT, 'content' => 'Название', 'default' => true],
	['id' => DictionaryTable::FIELD_OUTPUT, 'content' => 'Символьный код', 'default' => true],
	['id' => DictionaryTable::FIELD_ACTIVE, 'content' => 'Активность', 'default' => true],
	['id' => DictionaryTable::FIELD_SKIP_TRANSLATE, 'content' => 'Сортировка', 'default' => true],
]);

while($element = $data->NavNext(true, "f_"))
{
	/**
	 * @var int $f_ID
	 * @var string $f_NAME
	 */

	$area = DictionaryTable::getByPrimary($f_ID)->fetchObject();

	// создание строки (экземпляра класса CAdminListRow)
	$row =& $lAdmin->AddRow($f_ID, $element);

	$row->AddCheckField("ACTIVE");

	$arActions = [];
	$arActions[] = [
		"ICON"    => "edit",
		"DEFAULT" => true,
		"TEXT"    => 'Изменить',
		"ACTION"  => $lAdmin->ActionRedirect(CRAFT_AREA_ADMIN_URL_EDIT_AREA . "?ID=" . $f_ID),
	];

	if($area->fillFields()->count() > 0)
	{
		$arActions[] = [
			"ICON"    => "edit",
			"DEFAULT" => true,
			"TEXT"    => 'Контент',
			"ACTION"  => $lAdmin->ActionRedirect(JEDI_AREA_ADMIN_URL_EDIT_CONTENT . "?ID=" . $f_ID),
		];
	}

	if($POST_RIGHT >= "W")
	{
		$arActions[] = [
			"ICON"   => "delete",
			"TEXT"   => 'Удалить',
			"ACTION" => "if(confirm('Точно удалить " . $f_NAME . "?')) " . $lAdmin->ActionDoGroup($f_ID, "delete"),
		];
	}

	$row->AddActions($arActions);

}


$lAdmin->AddFooter(
	[
		["title" => "Количество записей", "value" => $res->getSelectedRowsCount()], // кол-во элементов
		["counter" => true, "title" => 'Выбрано записей', "value" => "0"], // счетчик выбранных элементов
	]
);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");
$lAdmin->DisplayList();
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php");
