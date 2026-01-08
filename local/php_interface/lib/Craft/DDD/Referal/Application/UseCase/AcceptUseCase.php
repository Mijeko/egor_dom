<?php

namespace Craft\DDD\Referal\Application\UseCase;

use Craft\DDD\Referal\Application\Contract\CodeGetterInterface;

class AcceptUseCase
{

	public function __construct(
		private CodeGetterInterface $codeGetter,
	)
	{
	}

	public function execute(): void
	{
		$refCode = $this->codeGetter->getCode();

	}

}