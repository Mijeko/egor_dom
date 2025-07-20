<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");

/**
 * @global CMain $APPLICATION
 */

$APPLICATION->SetTitle("Города");

use Bitrix\Main\Loader;
use Craft\DDD\City\Infrastructure\Entity\CityTable;

foreach(['craft.develop'] as $module)
{
	if(!Loader::includeModule($module))
	{
		$APPLICATION->ThrowException('Не подключен модуль ' . $module);
	};
}

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

if($request->getPost('action_button'))
{
	$elementIdList = $request->getPost('ID');
	if($elementIdList)
	{
		if(is_array($elementIdList))
		{
			$modelList = CityTable::getList([
				'filter' => [
					'ID' => $elementIdList,
				],
			])->fetchCollection();

			foreach($modelList as $area)
			{
				try
				{
					$area->delete();
				} catch(\Bitrix\Main\ArgumentException $e)
				{

				} catch(\Bitrix\Main\SystemException $e)
				{

				}
			}
		}
	}
}


$res = CityTable::getList([
	'order' => [
		CityTable::F_ID => 'DESC',
	],
]);
$POST_RIGHT = $APPLICATION->GetGroupRight("craft.develop");
$table_id = CityTable::getTableName(); // ид таблицы
$lAdmin = new CAdminList($table_id);

// Какие поля выводить
$lAdmin->AddHeaders([
	['id' => CityTable::F_ID, 'content' => 'ID', 'default' => true],
	['id' => CityTable::F_NAME, 'content' => 'Название', 'default' => true],
	['id' => CityTable::F_ACTIVE, 'content' => 'Активность', 'default' => true],
	['id' => CityTable::F_IS_DEFAULT, 'content' => 'Город по умолчанию', 'default' => true],
]);

$data = new CAdminResult($res, $table_id);

while($element = $data->NavNext(true, "f_"))
{
	/**
	 * @var int $f_ID
	 * @var string $f_NAME
	 * @var int $f_USER_ID
	 */


	$area = CityTable::getByPrimary($f_ID)->fetchObject();

	// создание строки (экземпляра класса CAdminListRow)
	$row =& $lAdmin->AddRow($f_ID, $element);

	$row->AddCheckField(CityTable::F_ACTIVE);
	$row->AddCheckField(CityTable::F_IS_DEFAULT);


	$arActions = [];
	$arActions[] = [
		"ICON"    => "edit",
		"DEFAULT" => true,
		"TEXT"    => 'Изменить',
		"ACTION"  => $lAdmin->ActionRedirect(CRAFT_DEVELOP_ADMIN_URL_EDIT_CITY . "?ID=" . $f_ID),
	];

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

$lAdmin->AddGroupActionTable([
	"delete"     => 'Удалить',
	"activate"   => 'Активировать',
	"deactivate" => 'Деактивировать',
]);

$aContext = [
	[
		"TEXT"  => 'Добавить город',
		"LINK"  => CRAFT_DEVELOP_ADMIN_URL_EDIT_CITY . "?lang=" . LANG,
		"TITLE" => 'Создать',
		"ICON"  => "btn_new",
	],
];

$lAdmin->AddAdminContextMenu($aContext);

$lAdmin->CheckListMode();

$rsData = new CAdminResult($res, $table_id);
$rsData->NavStart();
$lAdmin->NavText($rsData->GetNavPrint('Элементы'));

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");

// Вывод данных
$lAdmin->DisplayList();


require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php");
?>
