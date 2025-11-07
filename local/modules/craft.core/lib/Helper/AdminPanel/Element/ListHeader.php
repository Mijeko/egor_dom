<?php

namespace Craft\Core\Helper\AdminPanel\Element;

class ListHeader
{
	public function __construct(
		private string $id,
		private string $content,
		private bool   $default,
	)
	{
	}

	public static function build(
		string $id,
		string $content,
		bool   $default,
	): ListHeader
	{
		return new self(
			$id,
			$content,
			$default,
		);
	}

	public function getId(): string
	{
		return $this->id;
	}

	public function getContent(): string
	{
		return $this->content;
	}


	public function getDefault(): bool
	{
		return $this->default;
	}
}