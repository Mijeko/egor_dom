<?php

namespace Craft\Dto;

class ApartmentFilterPropDto
{

	public string $name;
	public string $type;
	public string $code;
	public $value;

	public static function build(
		string $name,
		string $code,
		string $type,
			   $value
	): ApartmentFilterPropDto
	{
		$self = new self();

		$self->name = $name;
		$self->type = $type;
		$self->code = $code;
		$self->value = $value;

		return $self;
	}
}