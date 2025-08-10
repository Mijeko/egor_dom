<?php

namespace Craft\Dto;

class ApartmentFilterPropValueDto
{
	public string $label;
	public string $value;

	public static function build(string $value, string $label): ApartmentFilterPropValueDto
	{
		$self = new self();
		$self->value = $value;
		$self->label = $label;
		return $self;
	}
}