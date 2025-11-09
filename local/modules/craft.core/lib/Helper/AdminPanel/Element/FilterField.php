<?php

namespace Craft\Core\Helper\AdminPanel\Element;

abstract class FilterField
{
	public abstract function render(): string;

	public abstract function getId(): string;

	public abstract function getLabel(): string;

}