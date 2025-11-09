<?php

namespace Craft\Core\Helper\AdminPanel;

abstract class Action
{

	public function __construct(
		protected string  $icon,
		protected bool    $default,
		protected string  $text,
		protected string  $action,
		protected ?string $access = null,
	)
	{
	}

	public static function instance(
		string  $icon,
		bool    $default,
		string  $text,
		string  $action,
		?string $access = null,
	): static
	{
		return new static(
			$icon,
			$default,
			$text,
			$action,
			$access,
		);
	}

	public function getSettings(): array
	{
		return [
			"ICON"    => $this->icon,
			"DEFAULT" => $this->default,
			"TEXT"    => $this->text,
			"ACTION"  => $this->action,
		];
	}

	public function hasAccess(string $compareAccess): bool
	{
		if(!$this->access)
		{
			return true;
		}

		return $compareAccess >= $this->access;
	}
}