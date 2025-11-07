<?php

namespace Craft\Core\Helper\AdminPanel\Element\ContextMenu;

abstract class Button
{

	public function __construct(
		protected string $text,
		protected string $link,
		protected string $title,
		protected string $icon,
	)
	{
	}

	public static function instance(
		string $text,
		string $link,
		string $title,
		string $icon,
	): static
	{
		return new static(
			$text,
			$link,
			$title,
			$icon,
		);
	}

	public function getTitle(): string
	{
		return $this->title;
	}


	public function getIcon(): string
	{
		return $this->icon;
	}

	public function getLink(): string
	{
		return $this->link;
	}

	public function getText(): string
	{
		return $this->text;
	}
}