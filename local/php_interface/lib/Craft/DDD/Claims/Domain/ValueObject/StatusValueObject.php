<?php

namespace Craft\DDD\Claims\Domain\ValueObject;

use Craft\DDD\Shared\Domain\Exceptions\FailedValueObjectValidateValueException;

class StatusValueObject
{
	const STATUS_NEW = 'new';
	const STATUS_WAIT_DOCS = 'wait_docs';
	const STATUS_FINISH = 'finish';

	public function getStatusList(): array
	{
		return $this->statues();
	}

	private function statues(): array
	{
		return [
			self::STATUS_NEW       => 'Заявка создана',
			self::STATUS_WAIT_DOCS => 'Ожидание документов',
			self::STATUS_FINISH    => 'Заявка завершена',
		];
	}

	private function icons(): array
	{
		return [
			self::STATUS_NEW       => '$invoicePlus',
			self::STATUS_FINISH    => '$success',
			self::STATUS_WAIT_DOCS => '$waitDocument',
		];
	}

	private function colors(): array
	{
		return [
			self::STATUS_NEW       => 'teal',
			self::STATUS_FINISH    => 'green-darken-1',
			self::STATUS_WAIT_DOCS => 'orange',
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
		if(array_key_exists($this->code, $this->icons()))
		{
			return $this->icons()[$this->code];
		}
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

	public function getColor(): ?string
	{
		if(array_key_exists($this->code, $this->colors()))
		{
			return $this->colors()[$this->code];
		}

		return null;
	}
}