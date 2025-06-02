<?php

namespace Craft\User\Application\Auth\Social\Entity;

use Craft\User\Application\Dto\AccessTokenResponseInterface;

interface AccessTokenInterface
{

	public static function instance(): AccessTokenInterface;

	public function getSessionKey(): string;

	public function store(AccessTokenResponseInterface $value): void;

	public function getTokenData(): ?AccessTokenResponseInterface;

	public function isAlive(): bool;
}