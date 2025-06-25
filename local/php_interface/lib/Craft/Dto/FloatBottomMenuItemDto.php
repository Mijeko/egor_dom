<?php

namespace Craft\Dto;

class FloatBottomMenuItemDto
{
	public function __construct(
		public string  $title,
		public string  $link,
		public ?string $icon = null,
	)
	{
	}

	public function getLink(): string
	{
		return $this->link;
	}

	public function getTitle(): string
	{
		return $this->title;
	}

	public function getIcon(): ?string
	{
		return $this->icon;
	}
}