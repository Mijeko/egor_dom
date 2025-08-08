<?php

namespace Craft\Dto;

class ApartmentFilterPropValueDto
{
	public string $key;
	public string $value;

	public static function build(string $key, string $value): ApartmentFilterPropValueDto
	{
		$self = new self();
		$self->key = $key;
		$self->value = $value;
		return $self;
	}
}