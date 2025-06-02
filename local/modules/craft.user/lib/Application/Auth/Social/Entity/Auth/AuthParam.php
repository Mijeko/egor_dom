<?php

namespace Craft\User\Application\Auth\Social\Entity\Auth;

interface AuthParam
{
	public static function init(): self;

	public function generate(bool $storeInSession = false): self;

	public function getValue(): string;

	public function storeInSession(): void;

	public function sessionValue(): ?string;
}