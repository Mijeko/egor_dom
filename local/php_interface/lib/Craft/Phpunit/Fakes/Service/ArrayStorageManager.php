<?php

namespace Craft\Phpunit\Fakes\Service;

use Craft\DDD\Referal\Application\Facade\StorageManager;
use Craft\Phpunit\Fakes\Storage\ArrayStorageInformation;

class ArrayStorageManager extends StorageManager
{

	public function __construct()
	{
		parent::__construct();
		$this->storageInformation = new ArrayStorageInformation();
	}
}