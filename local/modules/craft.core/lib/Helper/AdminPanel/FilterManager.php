<?php

namespace Craft\Core\Helper\AdminPanel;

use Bitrix\Main\Localization\Loc;
use Craft\Core\Helper\AdminPanel\Element\FilterField;

class FilterManager
{

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
//				return $field->getId();
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
}