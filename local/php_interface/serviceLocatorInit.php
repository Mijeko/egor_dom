<?php


use Symfony\Component\EventDispatcher\EventDispatcher;

//\Bitrix\Main\DI\ServiceLocator::getInstance()->addInstanceLazy(
//	'',
//	'',
//);


\Bitrix\Main\DI\ServiceLocator::getInstance()->addInstance(
	\Symfony\Component\EventDispatcher\EventDispatcher::class,
	new EventDispatcher(),
);

if(!function_exists('dispatcher'))
{
	function dispatcher(): EventDispatcher
	{
		return \Bitrix\Main\DI\ServiceLocator::getInstance()->get(EventDispatcher::class);
	}
}