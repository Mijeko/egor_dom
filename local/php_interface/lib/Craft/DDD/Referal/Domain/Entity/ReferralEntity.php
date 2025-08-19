<?php

namespace Craft\DDD\Referal\Domain\Entity;

class ReferralEntity
{
	private int $id;
	private string $code;
	private int $userId;
	private string $link;

	public static function create(): ReferralEntity
	{
		return new self();
	}

	public static function hydrate(): ReferralEntity
	{
		$self = new self();
		return $self;
	}
}