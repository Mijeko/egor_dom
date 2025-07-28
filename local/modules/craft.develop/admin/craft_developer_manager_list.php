<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");

/**
 * @global CMain $APPLICATION
 */

$APPLICATION->SetTitle("Менеджеры");

use Bitrix\Main\Loader;
use Bitrix\Main\UserGroupTable;
use Craft\Model\CraftUserTable;

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
			$buildObjectList = CraftUserTable::getList([
				'filter' => [
					'ID' => $elementIdList,
				],
			])->fetchCollection();

			foreach($buildObjectList as $buildObject)
			{
				try
				{
					$apartments = $buildObject->fillApartments();
					foreach($apartments as $apartment)
					{
						$apartment->delete();
					}

					$buildObject->delete();
				} catch(\Bitrix\Main\ArgumentException $e)
				{
					\Bitrix\Main\Diag\Debug::dumpToFile($e->getMessage());
				} catch(\Bitrix\Main\SystemException $e)
				{
					\Bitrix\Main\Diag\Debug::dumpToFile($e->getMessage());
				}
			}
		}
	}
}

$groupList = UserGroupTable::getList([
	'filter' => [
		'=GROUP_ID' => USER_GROUP_MANAGER_ID,
	],
	'cache'  => ['ttl' => 3600 * 48],
])->fetchCollection();


$res = CraftUserTable::getList([
	'order'  => [
		CraftUserTable::F_ID => 'DESC',
	],
	'filter' => [
		'ID' => $groupList->getUserIdList(),
	],
]);

$POST_RIGHT = $APPLICATION->GetGroupRight("craft.develop");
$table_id = CraftUserTable::getTableName(); // ид таблицы
$lAdmin = new CAdminList($table_id);

// Какие поля выводить
$lAdmin->AddHeaders([
	['id' => CraftUserTable::F_ID, 'content' => 'ID', 'default' => true],
	['id' => CraftUserTable::F_EMAIL, 'content' => 'E-Mail', 'default' => true],
	['id' => CraftUserTable::F_ACTIVE, 'content' => 'Активность', 'default' => true],
]);

$data = new CAdminResult($res, $table_id);

while($element = $data->NavNext(true, "f_"))
{
	/**
	 * @var int $f_ID
	 * @var string $f_NAME
	 */


	$buildObject = CraftUserTable::getByPrimary($f_ID)->fetchObject();

	// создание строки (экземпляра класса CAdminListRow)
	$row =& $lAdmin->AddRow($f_ID, $element);

	$row->AddCheckField("ACTIVE");

	$arActions = [];
	$arActions[] = [
		"ICON"    => "edit",
		"DEFAULT" => true,
		"TEXT"    => 'Изменить',
		"ACTION"  => $lAdmin->ActionRedirect(CRAFT_DEVELOP_ADMIN_URL_EDIT_MANAGER . "?ID=" . $f_ID),
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
		"TEXT"  => 'Добавить менеджера',
		"LINK"  => CRAFT_DEVELOP_ADMIN_URL_EDIT_MANAGER . "?lang=" . LANG,
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
