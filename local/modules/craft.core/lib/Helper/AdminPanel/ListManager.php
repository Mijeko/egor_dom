<?php

namespace Craft\Core\Helper\AdminPanel;

use Bitrix\Main\Application;
use Bitrix\Main\Diag\Debug;
use Bitrix\Main\HttpRequest;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Query\Result;
use Bitrix\Main\Request;
use CAdminList;
use CAdminResult;
use Craft\Core\Helper\AdminPanel\Element\ContextMenu\Button;
use Craft\Core\Helper\AdminPanel\Element\ListHeader;
use Exception;


class ListManager
{
	private FilterManager $filter;


	/** @var $actions array<int,callable> */
	private array $actions = [];


	/** @var $headers ListHeader[] */
	private array $headers = [];

	/** @var $headers Button[] */
	private array $contextButtons = [];
	private array $modules = [];

	private ?string $driver = null;

	private $rights;

	private Request|HttpRequest $request;

	private Result $result;

	private CAdminList $lAdmin;

	private string $by = 'ID';
	private string $order = 'desc';


	public function __construct(
		private string $moduleId,
		private string $tableId,
	)
	{
		$this->permissions();
		$this->request = Application::getInstance()->getContext()->getRequest();
		$oSort = new \CAdminSorting($this->tableId, $this->by, $this->order);
		$this->lAdmin = new CAdminList($this->tableId, $oSort);

		$this->by = mb_strtoupper($oSort->getField());
		$this->order = $oSort->getOrder();
	}

	public static function instance(
		string $moduleId,
		string $tableId,
	): ListManager
	{
		return new static(
			$moduleId,
			$tableId,
		);
	}

	private function permissions(): void
	{
		global $APPLICATION;

		$this->rights = $APPLICATION->GetGroupRight($this->moduleId);

		if($this->rights == "D")
		{
			$APPLICATION->AuthForm(Loc::getMessage("ACCESS_DENIED"));
		}
	}

	public function actions(array $actions): ListManager
	{
		foreach($actions as $action)
		{
			if(is_callable($action))
			{
				$this->actions[] = $action;
			}
		}

		return $this;
	}

	public function driver(string $driver): ListManager
	{
		$this->driver = $driver;
		return $this;
	}

	public function filter(FilterManager $filter): ListManager
	{
		$this->filter = $filter;
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

	private function includeModules(): void
	{
		foreach($this->modules as $module)
		{
			if(!Loader::includeModule($module))
			{
				throw new Exception("Module {$module} not found");
			}
		}
	}

	private function loadData(): void
	{
		$res = $this->driver::getList([
			'order'  => [
				$this->by => $this->order,
			],
			'filter' => $this->filter->getPreparedFilter(),
		]);
		$this->result = $res;
	}

	private function renderData(): void
	{
		$iterator = new CAdminResult($this->result, $this->tableId);

		while($element = $iterator->Fetch())
		{
			$id = $element['ID'];
			$name = $element['NAME'] ?? "Элемент с ID " . $id;

			$row =& $this->lAdmin->AddRow($id, $element);


			$arActions = [];
			foreach($this->actions as $_action)
			{
				$action = $_action($this->lAdmin, $id, $name);
				if(!$action instanceof Action)
				{
					continue;
				}

				if($action->hasAccess($this->rights))
				{
					$arActions[] = $action->getSettings();
				}
			}

			$row->AddActions($arActions);
		}

	}

	private function handleMassAction(): void
	{
		$this->editAll();

		if(($elementIdList = $this->lAdmin->GroupAction()) && $this->rights == "W")
		{

			global $DB;

			$action = $this->lAdmin->GetAction();

			// пройдем по списку элементов
			foreach($elementIdList as $elementId)
			{
				if(strlen($elementId) <= 0)
				{
					continue;
				}

				$elementId = IntVal($elementId);

				// для каждого элемента совершим требуемое действие
				switch($action)
				{
					case "delete":
						@set_time_limit(0);
						$DB->StartTransaction();

						$result = $this->driver::delete($elementId);
						if(!$result->isSuccess())
						{
							$DB->Rollback();
							$this->lAdmin->AddGroupError(Loc::getMessage("rub_del_err") . implode('<br>', $result->getErrorMessages()), $elementId);
						}

						$DB->Commit();
						break;

					case "activate":
					case "deactivate":
						try
						{
							$element = $this->driver::getByPrimary($elementId)->fetch();
							if($element)
							{
								$result = $this->driver::update($elementId, [
									"ACTIVE" => $_REQUEST['action'] == "activate" ? 'Y' : 'N',
								]);

								if(!$result->isSuccess())
								{
									$this->lAdmin->AddGroupError(Loc::getMessage("rub_save_error") . implode('<br>', $result->getErrorMessages()), $elementId);
								}
							} else
							{
								$this->lAdmin->AddGroupError(Loc::getMessage("rub_save_error") . " " . Loc::getMessage("rub_no_rubric"), $elementId);
							}
						} catch(\Exception $e)
						{
							$this->lAdmin->AddGroupError($e->getMessage(), $elementId);
						}
				}
			}
		}
	}

	private function editAll(): void
	{
		if($this->lAdmin->EditAction() && $this->rights == "W")
		{
			// пройдем по списку переданных элементов
			foreach($this->lAdmin->GetEditFields() as $ID => $arFields)
			{
			}
		}
	}

	public function build(): void
	{

		$this->handleMassAction();


		$this->lAdmin->AddHeaders(array_map(function(ListHeader $header) {
			return ['id' => $header->getId(), 'content' => $header->getContent(), 'default' => $header->getDefault(), 'sort' => $header->getSort()];
		}, $this->headers));


		$this->lAdmin->InitFilter($this->filter->getInitFields());


		$this->loadData();
		$this->renderData();

		$this->lAdmin->AddFooter(
			[
				["title" => "Количество записей", "value" => $this->result->getSelectedRowsCount()], // кол-во элементов
				["counter" => true, "title" => 'Выбрано записей', "value" => "0"], // счетчик выбранных элементов
			]
		);

		$this->lAdmin->AddGroupActionTable([
			"delete"     => 'Удалить',
			"activate"   => 'Активировать',
			"deactivate" => 'Деактивировать',
		]);


		$this->lAdmin->AddAdminContextMenu(array_map(function(Button $button) {
			return [
				"TEXT"  => $button->getText(),
				"LINK"  => $button->getLink(),
				"TITLE" => $button->getTitle(),
				"ICON"  => $button->getIcon(),
			];
		}, $this->contextButtons));
		$this->lAdmin->CheckListMode();


		$rsData = new CAdminResult($this->result, $this->tableId);
		$rsData->NavStart();
		$this->lAdmin->NavText($rsData->GetNavPrint('Элементы'));

	}

	public function show(): void
	{
		$this->filter->show();
		$this->lAdmin->DisplayList();
	}
}