<?php

namespace Craft\DDD\Developers\Domain\ValueObject;

class BuiltStateValueObject
{

	protected array $status = [
		'built' => 'Построено',
	];

	public function __construct(
		protected ?string $value
	)
	{
	}

	public function getValue(): ?string
	{
		return $this->value;
	}

	public function getLabel(): ?string
	{
		$key = $this->getValue();

		if(!$key)
		{
			return null;
		}

		return !empty($this->status[$key]) ? $this->status[$key] : null;
	}
}