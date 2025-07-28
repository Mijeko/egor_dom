<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");

/**
 * @global CMain $APPLICATION
 */

$APPLICATION->SetTitle("Заявки");

use Bitrix\Main\Loader;
use Craft\DDD\Claims\Infrastructure\Entity\ClaimTable;

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
			$areaList = ClaimTable::getList([
				'filter' => [
					'ID' => $elementIdList,
				],
			])->fetchCollection();

			foreach($areaList as $area)
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


$res = ClaimTable::getList([
	'order' => [
		ClaimTable::F_ID => 'DESC',
	],
]);
$POST_RIGHT = $APPLICATION->GetGroupRight("craft.develop");
$table_id = ClaimTable::getTableName(); // ид таблицы
$lAdmin = new CAdminList($table_id);

// Какие поля выводить
$lAdmin->AddHeaders([
	['id' => ClaimTable::F_ID, 'content' => 'ID', 'default' => true],
	['id' => ClaimTable::F_APARTMENT_ID, 'content' => 'ID квартиры', 'default' => true],
	['id' => ClaimTable::F_NAME, 'content' => 'Название', 'default' => true],
	['id' => ClaimTable::F_ACTIVE, 'content' => 'Активность', 'default' => true],
	['id' => ClaimTable::F_USER_ID, 'content' => 'Пользователь', 'default' => true],
]);

$data = new CAdminResult($res, $table_id);

while($element = $data->NavNext(true, "f_"))
{
	/**
	 * @var int $f_ID
	 * @var string $f_NAME
	 * @var int $f_USER_ID
	 */


	$area = ClaimTable::getByPrimary($f_ID)->fetchObject();

	// создание строки (экземпляра класса CAdminListRow)
	$row =& $lAdmin->AddRow($f_ID, $element);

	$row->AddCheckField(ClaimTable::F_ACTIVE);

	if($user = \Craft\Model\CraftUser::load($f_USER_ID))
	{
		$row->AddField(ClaimTable::F_USER_ID, $user->getName());
	}

	$arActions = [];
	$arActions[] = [
		"ICON"    => "edit",
		"DEFAULT" => true,
		"TEXT"    => 'Изменить',
		"ACTION"  => $lAdmin->ActionRedirect(CRAFT_DEVELOP_ADMIN_URL_EDIT_CLAIMS . "?ID=" . $f_ID),
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
		"TEXT"  => 'Добавить объект',
		"LINK"  => CRAFT_DEVELOP_ADMIN_URL_EDIT_CLAIMS . "?lang=" . LANG,
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
