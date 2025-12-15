<?php

namespace Craft\DDD\User\Application\Contract;

interface CurrentUserProviderInterface
{
	public function getUserId(): ?int;
}