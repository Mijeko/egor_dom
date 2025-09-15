<?php

namespace Craft\Helper;

class TableHeaderHelper
{
	public string $key;
	public string $title;
	public ?string $align = null;

	public static function build(string $key, string $title, ?string $align = null): TableHeaderHelper
	{
		$self = new self();
		$self->key = $key;
		$self->title = $title;
		$self->align = $align;
		return $self;
	}
}