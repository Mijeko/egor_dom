<?php

namespace Craft\DDD\User\Application\Service\Interfaces;

interface AutenficatorInterface
{
	public function loginById(int $userId): bool;
}