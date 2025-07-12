<?php

namespace Craft\DDD\Shared\Domain\Exceptions;

class FailedValueObjectValidateValueException extends \Exception
{
	protected $code = 500;
	protected $message = 'Invalid value provided';
}