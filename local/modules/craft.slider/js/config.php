<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$root = '/local/modules/craft.slider/js';

$libs = [
	'craft.slider.jquery' => [
		'js' => $root . '/craft.slider/jquery-3.7.1.js',
	],
	'craft.slider.core'   => [
		'js'  => $root . '/craft.slider.core/slider.js',
		'rel' => [
			'craft.slider.jquery',
			'craft.slider.swiper',
		],
	],
	'craft.slider.swiper' => [
		'css' => $root . '/craft.slider.swiper/swiper-bundle.min.css',
		'js'  => $root . '/craft.slider.swiper/swiper-bundle.min.js',
	],
	'craft.slider.admin'  => [
		'js'  => $root . '/craft.slider.admin/script.js',
		'css' => $root . '/craft.slider.admin/style.css',
		'rel' => [
			'craft.slider.jquery',
		],
	],
	'craft.slider.toggle' => [
		'js' => $root . '/craft.slider.toggle/script.js',
	],
];

foreach($libs as $libName => $lib)
{
	if(!isset($lib['skip_core']))
	{
		$lib['skip_core'] = true;
	}

	CJSCore::RegisterExt($libName, $lib);
}
