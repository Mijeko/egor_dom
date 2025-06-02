<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$root = '/local/modules/craft.form/js';

$libs = [
	'craft.form.core'   => [
		'js'  => $root . '/craft.form.core/script.js',
		'rel' => [
			'craft.form.jquery',
		],
	],
	'craft.form.jquery' => [
		'js' => $root . '/craft.form.jquery/jquery-3.7.1.js',
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
