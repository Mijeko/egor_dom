<?php

namespace Craft\Core\Helper\AdminPanel\Element;

class ListHeader
{
	public function __construct(
		private string  $id,
		private string  $content,
		private bool    $default,
		private ?string $sort = null,
	)
	{
	}

	public static function build(
		string  $id,
		string  $content,
		bool    $default,
		?string $sort = null,
	): ListHeader
	{
		return new self(
			$id,
			$content,
			$default,
			$sort
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

	public function getSort(): ?string
	{
		return $this->sort;
	}
}