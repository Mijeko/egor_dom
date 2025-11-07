<?php

namespace Craft\Core\Helper\AdminPanel;

use Bitrix\Main\Application;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\HttpRequest;
use Bitrix\Main\Loader;
use Bitrix\Main\Request;
use Bitrix\Main\SystemException;
use Craft\Core\Helper\AdminPanel\Element\ContextMenu\Button;
use Craft\Core\Helper\AdminPanel\Element\ListHeader;
use Craft\DDD\City\Infrastructure\Entity\CityTable;
use Craft\DDD\Developers\Infrastructure\Entity\DeveloperTable;

class ListManager
{
	/** @var $headers ListHeader[] */
	private array $headers = [];

	/** @var $headers Button[] */
	private array $contextButtons = [];
	private array $modules = [];

	private ?string $driver = null;

	private Request|HttpRequest $request;

	public static function instance(): ListManager
	{
		return new static();
	}

	public function driver(string $driver): ListManager
	{
		$this->driver = $driver;
		return $this;
	}

	public function headers(array $headers): ListManager
	{
		foreach($headers as $header)
		{
			if($header instanceof ListHeader)
			{
				$this->headers[] = $header;
			}
		}

		return $this;
	}

	public function modules(string ...$modules): ListManager
	{
		foreach($modules as $module)
		{
			$this->modules[] = $module;
		}

		return $this;
	}

	public function contextButtons(array $buttons): ListManager
	{
		foreach($buttons as $button)
		{
			if($button instanceof Button)
			{
				$this->contextButtons[] = $button;
			}
		}
		return $this;
	}

	public function __construct()
	{
		$this->request = Application::getInstance()->getContext()->getRequest();
	}

	private function includeModules(): void
	{
		foreach($this->modules as $module)
		{
			if(!Loader::includeModule($module))
			{
				throw new \Exception("Module {$module} not found");
			}
		}
	}

	public function show(): void
	{

		if(!$this->driver)
		{
			return;
		}

		global $APPLICATION;

		try
		{
			$this->includeModules();
		} catch(\Exception $e)
		{
			return;
		}

		if($this->request->getPost('action_button'))
		{
			$elementIdList = $this->request->getPost('ID');
			if($elementIdList)
			{
				if(is_array($elementIdList))
				{
					$areaList = DeveloperTable::getList([
						'filter' => [
							'ID' => $elementIdList,
						],
					])->fetchCollection();

					foreach($areaList as $area)
					{
						try
						{
							$area->delete();
						} catch(ArgumentException $e)
						{

						} catch(SystemException $e)
						{

						}
					}
				}
			}
		}


		$res = DeveloperTable::getList([
			'order' => [
				DeveloperTable::F_ID => 'DESC',
			],
		]);
		$POST_RIGHT = $APPLICATION->GetGroupRight("craft.develop");
		$table_id = DeveloperTable::getTableName(); // ид таблицы
		$lAdmin = new \CAdminList($table_id);

		// Какие поля выводить
		$lAdmin->AddHeaders(array_map(function(ListHeader $header) {
			return [
				'id'      => $header->getId(),
				'content' => $header->getContent(),
				'default' => $header->getDefault(),
			];
		}, $this->headers));

		$data = new \CAdminResult($res, $table_id);

		while($element = $data->NavNext(true, "f_"))
		{
			/**
			 * @var int $f_ID
			 * @var string $f_NAME
			 */


			$area = DeveloperTable::getByPrimary($f_ID)->fetchObject();

			// создание строки (экземпляра класса CAdminListRow)
			$row =& $lAdmin->AddRow($f_ID, $element);

			$row->AddCheckField("ACTIVE");

			if($city = CityTable::getByPrimary($area->getCityId())->fetchObject())
			{
				$row->AddField(DeveloperTable::F_CITY_ID, $city->getName() ?? 'Не назначено');
			}

			$arActions = [];
			$arActions[] = [
				"ICON"    => "edit",
				"DEFAULT" => true,
				"TEXT"    => 'Изменить',
				"ACTION"  => $lAdmin->ActionRedirect(CRAFT_DEVELOP_ADMIN_URL_EDIT_DEVELOPERS . "?ID=" . $f_ID),
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

		$aContext = array_map(function(Button $button) {
			return [
				"TEXT"  => $button->getText(),
				"LINK"  => $button->getLink(),
				"TITLE" => $button->getTitle(),
				"ICON"  => $button->getIcon(),
			];
		}, $this->contextButtons);

		$lAdmin->AddAdminContextMenu($aContext);

		$lAdmin->CheckListMode();

		$rsData = new \CAdminResult($res, $table_id);
		$rsData->NavStart();
		$lAdmin->NavText($rsData->GetNavPrint('Элементы'));

		require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");

		// Вывод данных
		$lAdmin->DisplayList();


		require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php");
	}

}