<?php

namespace Craft\DDD\User\Application\Contract;

interface PasswordGeneratorInterface
{
	public function generate(int $length = 16): string;
}