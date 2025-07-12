<?php

namespace Craft\DDD\Claims\Domain\ValueObject;

use Bitrix\Main\Diag\Debug;
use Craft\DDD\Shared\Domain\Exceptions\FailedValueObjectValidateValueException;

class StatusValueObject
{
	const STATUS_NEW = 'new';

	private function statues(): array
	{
		return [
			self::STATUS_NEW => 'Заявка создана',
		];
	}

	public function __construct(
		protected ?string $code
	)
	{
		if(is_null($this->code) || mb_strlen($this->code) == 0)
		{
			$this->code = self::STATUS_NEW;
		}

		$this->validate($this->code);
	}

	protected function validate(?string $value): void
	{
		if(!is_null($value) && !array_key_exists($value, $this->statues()))
		{
			throw new FailedValueObjectValidateValueException('Некорректное значение статуса');
		}
	}

	public static function newClaim(): static
	{
		return new static(self::STATUS_NEW);
	}

	public function getCode(): string
	{
		return $this->code;
	}

	public function getIcon(): ?string
	{
		return null;
	}

	public function getLabel(): ?string
	{
		if(array_key_exists($this->code, $this->statues()))
		{
			return $this->statues()[$this->code];
		}

		return null;
	}
}