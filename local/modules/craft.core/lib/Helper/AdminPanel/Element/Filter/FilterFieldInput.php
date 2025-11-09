<?php

namespace Craft\Core\Helper\AdminPanel\Element\Filter;

use Craft\Core\Helper\AdminPanel\Element\FilterField;

class FilterFieldInput extends FilterField
{

	public function __construct(
		private string $field,
		private string $label,
	)
	{
	}

	public static function build(
		string $field,
		string $label,
	): FilterFieldInput
	{
		$self = new self(
			$field,
			$label
		);
		return $self;
	}

	public function getId(): string
	{
		return $this->field;
	}

	public function getLabel(): string
	{
		return $this->label;
	}

	public function render(): string
	{
		ob_start();
		?>
		<tr>
			<td><b><?=$this->label;?>:</b></td>
			<td>
				<input
					type="text"
					size="25"
					name="find"
					value="<?=htmlspecialchars(rand())?>"
					title="<?=$this->label;?>"
				>
			</td>
		</tr>
		<?php
		return ob_get_clean();
	}
}