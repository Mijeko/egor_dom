<?php

namespace Craft\User\Application\Auth\Social\Entity\Auth;


final class CodeChallenge extends AbstractAuthParam
{


	function getSessionKey(): string
	{
		return 'code_challenge';
	}

	public static function init(): CodeChallenge
	{
		return new static();
	}

	public function generate(bool $storeInSession = false): CodeChallenge
	{
		$self = new static();

		$self->value = $self->generateCodeChallenge(CodeVerifier::init()->sessionValue());

		if($storeInSession)
		{
			$self->storeInSession();
		}

		return $self;
	}

	private function generateCodeChallenge(string $code_verifier): string
	{
		return rtrim(strtr(base64_encode(hash('sha256', $code_verifier, true)), '+/', '-_'), '=');
	}
}