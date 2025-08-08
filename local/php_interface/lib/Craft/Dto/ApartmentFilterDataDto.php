<?php

namespace Craft\Dto;

class ApartmentFilterDataDto
{

	public function __construct(
		public array $props
	)
	{
		foreach($this->props as $prop)
		{
			if(!$prop instanceof ApartmentFilterPropDto)
			{
				throw new \Exception('Неликвидные данные');
			}
		}
	}

}