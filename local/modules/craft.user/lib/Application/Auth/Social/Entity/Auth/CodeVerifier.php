<?php

namespace Craft\User\Application\Auth\Social\Entity\Auth;

final class CodeVerifier extends AbstractAuthParam
{
	public function getSessionKey(): string
	{
		return 'code_verifier';
	}

	public static function init(): CodeVerifier
	{
		return new self();
	}

	public function generate(bool $storeInSession = false): CodeVerifier
	{
		$self = new static();

		$self->value = $self->generateCodeVerifier();

		if($storeInSession)
		{
			$self->storeInSession();
		}

		return $self;
	}

	private function generateCodeVerifier(int $length = 128): string
	{
		return bin2hex(random_bytes($length / 2));
	}
}