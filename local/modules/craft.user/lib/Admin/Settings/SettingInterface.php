<?php

namespace Craft\User\Admin\Settings;

interface SettingInterface
{
	public static function instance(): self;

	public function name(): string;

	public function getModule(): string;

	public function save($value): void;


	/**
	 * @return null|string|array
	 */
	public function value();

	public function label(string $key): ?string;
}