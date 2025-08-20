<?php

namespace Craft\DDD\Referal\Infrastructure\Event;

use Symfony\Contracts\EventDispatcher\Event;

class AssignUserAgentEvent extends Event
{
	public function __construct() { }
}