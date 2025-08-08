<?php

namespace Craft\Dto;

class ApartmentFilterPropDto
{

	public string $name;
	public string $code;
	public $value;

	public static function build(
		string $name,
		string $code,
			   $value
	): ApartmentFilterPropDto
	{
		$self = new self();

		$self->name = $name;
		$self->code = $code;
		$self->value = $value;

		return $self;
	}
}