<?php

namespace Craft\Core\Helper\AdminPanel;

use Bitrix\Main\Application;
use Craft\Core\Helper\AdminPanel\Element\FilterField;

class FilterManager
{
	private string $prefix = 'find_';

	/** @var $fields array<int, FilterField> */
	private array $fields = [];

	public function __construct(
		private string $tableId

	)
	{
	}

	public static function instance(
		string $tableId
	): FilterManager
	{
		$self = new self(
			$tableId
		);

		return $self;
	}

	public function fields(array $fields): FilterManager
	{
		$this->fields = $fields;
		return $this;
	}

	public function show(): void
	{
		$oFilter = new \CAdminFilter(
			$this->tableId . "_filter",
			array_map(function(FilterField $field) {
				return $field->getLabel();
			}, $this->fields)
		);

		global $APPLICATION;

		ob_start();
		?>
		<form name="find_form" method="get" action="<?=$APPLICATION->GetCurPage();?>">
			<?php
			$oFilter->Begin();
			?>

			<?php
			foreach($this->fields as $field)
			{
				echo $field->render();
			}
			?>

			<?php
			$oFilter->Buttons(["table_id" => $this->tableId, "url" => $APPLICATION->GetCurPage(), "form" => "find_form"]);
			$oFilter->End();
			?>
		</form>
		<?php
		echo ob_get_clean();
	}

	public function getInitFields(): array
	{
		return array_map(function(FilterField $field) {
			return $this->prefix . $field->getId();
		}, $this->fields);
	}

	public function getPreparedFilter(): array
	{
		$request = Application::getInstance()->getContext()->getRequest();

		$_filter = array_reduce($this->fields,
			function(array $carry, FilterField $field) use ($request) {

				$fieldCode = $this->prefix . $field->getId();

				$_value = $request->get($fieldCode);

				if($_value)
				{
					$carry[$field->getId()] = $_value;
				}


				return $carry;
			},
			[]
		);

		return array_filter($_filter);
	}
}