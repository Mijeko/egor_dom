<?php

namespace Craft\DDD\Developers\Domain\ValueObject;

class UrlValueObject
{
	public function __construct(
		protected string $url
	)
	{

		$this->validate();
	}

	protected function validate()
	{
		if(!$this->url)
		{
			throw new \Exception('URL не может быть пустым');
		}
	}

	public function getUrl(): string
	{
		return $this->url;
	}
}