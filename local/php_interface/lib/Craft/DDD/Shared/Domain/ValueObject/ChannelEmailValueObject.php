<?php

namespace Craft\DDD\Shared\Domain\ValueObject;

class ChannelEmailValueObject
{
	public function __construct(
		protected ?string $email,
	)
	{

		$this->validate();

	}

	protected function validate()
	{
		if(is_null($this->email))
		{
			return;
		}

		if(mb_strlen($this->email) <= 0)
		{
			throw new \Exception('E-Mail должен быть больше 0 символа');
		}
	}

	public function getEmail(): ?string
	{
		return $this->email;
	}
}