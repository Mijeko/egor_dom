<?php

namespace Craft\User\Application\Auth\Social\Entity\Auth;

final class State extends AbstractAuthParam
{
	public static function init(): State
	{
		return new static();
	}

	public function generate(bool $storeInSession = false): self
	{
		$self = new static();

		$self->value = bin2hex(random_bytes(16));

		if($storeInSession)
		{
			$self->storeInSession();
		}

		return $self;
	}

	function getSessionKey(): string
	{
		return 'state';
	}
}