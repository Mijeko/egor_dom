<?php

namespace Craft\DDD\User\Application\Service\Interfaces;

interface PasswordGeneratorInterface
{
	public function generate(int $length = 16): string;
}