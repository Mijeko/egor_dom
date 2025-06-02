<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$root = '/local/modules/craft.modal/js';

$libs = [
	'craft.modal.core'     => [
		'js'  => $root . '/core/script.js',
		'rel' => [
			'craft.modal.fancybox',
		],
	],
	'craft.modal.jquery'   => [
		'js' => $root . '/jquery/jquery-3.7.1.js',
	],
	'craft.modal.fancybox' => [
		'js'  => $root . '/modal.fancybox/fbox.js',
		'css' => $root . '/modal.fancybox/fbox.css',
		'rel' => [
			'craft.modal.jquery',
		],
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

