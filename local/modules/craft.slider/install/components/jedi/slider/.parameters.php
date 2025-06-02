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
	],
	"PARAMETERS" => [
		"IBLOCK_TYPE"    => [
			"PARENT"            => "SETTINGS",
			"NAME"              => 'Тип инфоблока',
			"TYPE"              => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES"            => $arIBlockType,
			"REFRESH"           => "Y",
		],
		"IBLOCK_ID"      => [
			"PARENT"            => "SETTINGS",
			"NAME"              => 'ID инфоблока',
			"TYPE"              => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES"            => $arIBlock,
			"REFRESH"           => "Y",
		],
		"SORT_KEY"       => [
			"PARENT"            => "SETTINGS",
			"NAME"              => 'Поле для сортировки',
			"TYPE"              => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES"            => [
				'ID'   => 'ID',
				'SORT' => 'Сортировка',
				'NAME' => 'Название',
			],
		],
		"SORT_DIRECTION" => [
			"PARENT" => "SETTINGS",
			"NAME"   => 'Направление сортировки',
			"TYPE"   => "LIST",
			"VALUES" => [
				'ASC'  => 'По возрастанию',
				'DESC' => 'По убыванию',
			],
		],
	],
];


if(!empty($arCurrentValues['IBLOCK_ID']))
{
	$properties[''] = 'Выбрать значение';
	$propertyQuery = CIBlockProperty::GetList(
		[
			'SORT' => 'ASC',
		],
		[
			'IBLOCK_ID' => $arCurrentValues['IBLOCK_ID'],
		]
	);

	while($property = $propertyQuery->GetNext())
	{
		$properties[$property['CODE']] = $property['NAME'];
	}

	$arComponentParameters['PARAMETERS']['PROPERTY'] = [
		"PARENT" => "SETTINGS",
		"NAME"   => 'Свойство слайдера',
		"TYPE"   => "LIST",
		"VALUES" => $properties,
	];
}