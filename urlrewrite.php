<?php
$arUrlRewrite = [
	0 =>
		[
			'CONDITION' => '#^\\/?\\/mobileapp/jn\\/(.*)\\/.*#',
			'RULE'      => 'componentName=$1',
			'ID'        => NULL,
			'PATH'      => '/bitrix/services/mobileapp/jn.php',
			'SORT'      => 100,
		],
	1 =>
		[
			'CONDITION' => '#^/rest/#',
			'RULE'      => '',
			'ID'        => NULL,
			'PATH'      => '/bitrix/services/rest/index.php',
			'SORT'      => 100,
		],
	2 => [
		'CONDITION' => '#^/local/rest/#',
		'RULE'      => '',
		'ID'        => 'bitrix:rest.hook',
		'PATH'      => '/local/rest/index.php',
	],
];
