<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var string $componentPath
 * @var string $componentName
 * @var array $arCurrentValues
 */

use Bitrix\Main\Loader;

if(!Loader::includeModule("iblock"))
{
	throw new \Exception('Не загружены модули необходимые для работы компонента');
}

# типы инфоблоков
$arIBlockType = CIBlockParameters::GetIBlockTypes();

# инфоблоки выбранного типа
$arIBlock = [];
$iblockFilter = !empty($arCurrentValues['IBLOCK_TYPE'])
	? ['TYPE' => $arCurrentValues['IBLOCK_TYPE'], 'ACTIVE' => 'Y']
	: ['ACTIVE' => 'Y'];

$rsIBlock = CIBlock::GetList(['SORT' => 'ASC'], $iblockFilter);
while($arr = $rsIBlock->Fetch())
{
	$arIBlock[$arr['ID']] = '[' . $arr['ID'] . '] ' . $arr['NAME'];
}
unset($arr, $rsIBlock, $iblockFilter);

$arComponentParameters = [
	"GROUPS"     => [
		"SETTINGS" => [
			"NAME" => 'Настройки',
			"SORT" => 550,
		],
		"MAIL"     => [
			"NAME" => 'Почта',
			"SORT" => 560,
		],
		"SECURITY" => [
			"NAME" => 'Безопасность',
			"SORT" => 570,
		],
	],
	"PARAMETERS" => [
		"IBLOCK_TYPE"   => [
			"PARENT"            => "SETTINGS",
			"NAME"              => 'Тип инфоблока',
			"TYPE"              => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES"            => $arIBlockType,
			"REFRESH"           => "Y",
		],
		"IBLOCK_ID"     => [
			"PARENT"            => "SETTINGS",
			"NAME"              => 'ID инфоблока',
			"TYPE"              => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES"            => $arIBlock,
			"REFRESH"           => "Y",
		],
		'RESPONSE_TYPE' => [
			'PARENT' => 'SETTINGS',
			'NAME'   => 'Формат выдачи ошибок',
			'TYPE'   => 'LIST',
			'VALUES' => \Craft\Form\Helper\Component\FormSettingsHelper::getErrorFormats(),
		],
		'SEND_MAIL'     => [
			'PARENT'  => 'MAIL',
			'NAME'    => 'Отправлять письмо',
			'TYPE'    => 'CHECKBOX',
			'REFRESH' => 'Y',
		],
		'USE_CAPTCHA'   => [
			'PARENT'  => 'SECURITY',
			'NAME'    => 'Использовать капчу',
			'TYPE'    => 'CHECKBOX',
			'REFRESH' => 'Y',
		],
	],
];


if(!empty($arCurrentValues['SEND_MAIL']) && $arCurrentValues['SEND_MAIL'] == 'Y')
{
	$arComponentParameters['PARAMETERS']['SEND_DUPLICATE'] = [
		'PARENT' => 'MAIL',
		'NAME'   => 'Отправить ли копию письма',
		'TYPE'   => 'CHECKBOX',
	];

	$arComponentParameters['PARAMETERS']['MAIL_EVENT_TYPE'] = [
		'PARENT'  => 'MAIL',
		'NAME'    => 'Почтовое событие',
		'TYPE'    => 'LIST',
		'VALUES'  => \Craft\Form\Helper\Component\FormSettingsHelper::getMailEvents(),
		'REFRESH' => 'Y',
	];
}


if(!empty($arCurrentValues['MAIL_EVENT_TYPE']))
{
	$arComponentParameters['PARAMETERS']['MAIL_MESSAGE_ID'] = [
		'PARENT' => 'MAIL',
		'NAME'   => 'Почтовое письмо',
		'TYPE'   => 'LIST',
		'VALUES' => \Craft\Form\Helper\Component\FormSettingsHelper::getMailMessages($arCurrentValues['MAIL_EVENT_TYPE']),
	];
}


if(!empty($arCurrentValues['USE_CAPTCHA']) && $arCurrentValues['USE_CAPTCHA'] == 'Y')
{
	$arComponentParameters['PARAMETERS']['CAPTCHA_TYPE'] = [
		'PARENT' => 'SECURITY',
		'NAME'   => 'Агрегатор капчи',
		'TYPE'   => 'LIST',
		'VALUES' => \Craft\Form\Helper\Component\FormSettingsHelper::captchaList(),
	];
}