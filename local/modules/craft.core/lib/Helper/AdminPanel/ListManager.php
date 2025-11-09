<?php

namespace Craft\Core\Helper\AdminPanel;

use Bitrix\Main\Application;
use Bitrix\Main\HttpRequest;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Query\Result;
use Bitrix\Main\Request;
use CAdminList;
use CAdminResult;
use Craft\Core\Helper\AdminPanel\Element\ContextMenu\Button;
use Craft\Core\Helper\AdminPanel\Element\FilterField;
use Craft\Core\Helper\AdminPanel\Element\ListHeader;
use Exception;


class ListManager
{
	private FilterManager $filter;

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


	public function __construct(
		private string $moduleId,
		private string $tableId,
	)
	{
		$this->permissions();
		$this->request = Application::getInstance()->getContext()->getRequest();
		$oSort = new \CAdminSorting($this->tableId, "ID", "desc");
		$this->lAdmin = new CAdminList($this->tableId, $oSort);
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
			$arActions[] = [
				"ICON"    => "edit",
				"DEFAULT" => true,
				"TEXT"    => 'Изменить',
				"ACTION"  => $this->lAdmin->ActionRedirect(CRAFT_DEVELOP_ADMIN_URL_EDIT_DEVELOPERS . "?ID=" . $id),
			];


			if($this->rights >= "W")
			{
				$arActions[] = [
					"ICON"   => "delete",
					"TEXT"   => 'Удалить',
					"ACTION" => "if(confirm('Точно удалить " . $name . "?')) " . $this->lAdmin->ActionDoGroup($id, "delete"),
				];
			}

			$row->AddActions($arActions);
		}

	}

	public function build(): void
	{
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