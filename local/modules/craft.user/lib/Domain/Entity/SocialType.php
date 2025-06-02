<?php

namespace Craft\User\Domain\Entity;

class SocialType
{
	protected string $name;

	public function __construct(
		string $name
	) {
		$this->name = $name;
	}

	public function getName(): string
	{
		return $this->name;
	}
}