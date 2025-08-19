<?php

namespace Craft\Helper;

class Criteria
{

	private bool $showSecureFields = false;

	private array $select = [];
	private array $order = [];
	private array $filter = [];
	private ?int $limit = null;

	private ?array $cache = [];

	public static function instance(array $order = [], array $filter = [], int $limit = null): Criteria
	{
		$self = new self();
		$self->order = $order;
		$self->filter = $filter;
		$self->limit = $limit;
		return $self;
	}

	public function makeGetListParams(): array
	{
		$preparedGetListParams = [];

		if($this->getFilter())
		{
			$preparedGetListParams['filter'] = $this->getFilter();
		}

		if($this->getOrder())
		{
			$preparedGetListParams['order'] = $this->getOrder();
		}

		if($this->getSelect())
		{
			$preparedGetListParams['select'] = $this->getSelect();
		}

		if($this->getLimit())
		{
			$preparedGetListParams['limit'] = $this->getLimit();
		}

		if($this->getCache())
		{
			$preparedGetListParams['cache'] = $this->getCache();
		}

		if($this->showSecureFields)
		{
			$preparedGetListParams['private_fields'] = true;
			$preparedGetListParams['select'] = array_merge($preparedGetListParams['select'], ['PASSWORD']);
		}

		return $preparedGetListParams;
	}

	public function cache(array $cache): Criteria
	{
		$this->cache = $cache;
		return $this;
	}

	public function getCache(): ?array
	{
		return $this->cache;
	}

	public function getSelect(): array
	{
		return $this->select;
	}

	public function useSecureFields(): Criteria
	{
		$this->showSecureFields = true;
		return $this;
	}

	public function select(array $select): Criteria
	{
		$this->select = array_merge($this->select, $select);
		return $this;
	}


	public function limit(int $limit): Criteria
	{
		$this->limit = $limit;
		return $this;
	}

	public function order(array $order): Criteria
	{
		$this->order = array_merge($this->order, $order);
		return $this;
	}

	public function filter(array $filter): Criteria
	{
		$this->filter = array_merge($this->filter, $filter);
		return $this;
	}


	public function getFilter(): array
	{
		return $this->filter;
	}

	public function getLimit(): ?int
	{
		return $this->limit;
	}

	public function getOrder(): array
	{
		return $this->order;
	}
}