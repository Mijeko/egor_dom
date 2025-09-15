<?php

namespace Craft\Helper;


class TableSettingsHelper
{

	/** @var TableHeaderHelper[] $header */
	private array $header = [];
	private array $records = [];


	public static function settings(): TableSettingsHelper
	{
		$self = new self();

		return $self;
	}

	public function header(array $headers): TableSettingsHelper
	{
		$this->header = $headers;
		return $this;
	}

	public function records(array $records): TableSettingsHelper
	{
		try
		{
			$this->records = $records;
		} catch(\Exception $exception)
		{
			$this->records = [];
		}


		return $this;
	}

	public function build(): array
	{
		return [
			'header'  => $this->header,
			'records' => $this->records,
		];
	}
}