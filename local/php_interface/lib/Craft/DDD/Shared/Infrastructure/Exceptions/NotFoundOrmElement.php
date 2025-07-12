<?php

namespace Craft\DDD\Shared\Infrastructure\Exceptions;

class NotFoundOrmElement extends \Exception
{
	protected $code = 500;
	protected $message = 'Элемент не найден в базе данных';
}