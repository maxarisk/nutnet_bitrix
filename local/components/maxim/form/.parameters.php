<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// checks for iblock module
use Bitrix\Main\Loader;

if (!Loader::includeModule('iblock')) {
	return;
}

// setup iblock list
$arIBlocks = [
	'' => GetMessage('T_IBLOCK_NO'),
];
$db_iblock = CIBlock::GetList(
	[
		'SORT'=>'ASC'
	],
	[
		'ACTIVE' => 'Y'
	]
);
while($arRes = $db_iblock->Fetch()) {
	$arIBlocks[$arRes['ID']] = '[' . $arRes['ID'] . '] ' . $arRes['NAME'];
}

$arProperty = [];
$arSelectedProperty = [];

if (!empty($arCurrentValues['IBLOCK_ID']) && (int)$arCurrentValues['IBLOCK_ID'] > 0) { // checks for selected iblock and setup property list
	$rsProps = CIBlockProperty::GetList(
		[
			'SORT' => 'ASC',
			'ID' => 'ASC'
		],
		[
			'IBLOCK_ID' => $arCurrentValues['IBLOCK_ID'],
			'ACTIVE' => 'Y'
		]
	);
	while ($arProp = $rsProps->Fetch()) {
		$strPropName = '['.$arProp['ID'].']'.('' != $arProp['CODE'] ? '['.$arProp['CODE'].']' : '').' '.$arProp['NAME'];
		if ('' == $arProp['CODE']) {
			$arProp['CODE'] = $arProp['ID'];
		}
		$arProperty[$arProp['CODE']] = $strPropName;
	}
}

if (!empty($arCurrentValues['PROP'])) // checks for selected properties and setup required property list
{
	if (!is_array($arCurrentValues['PROP']))
	{
		$arCurrentValues['PROP'] = array($arCurrentValues['PROP']);
	}

	foreach ($arCurrentValues['PROP'] as $name)
	{
		if (isset($arProperty[$name]))
		{
			$arSelectedProperty[$name] = $arProperty[$name];
		}
	}
}

$arComponentParameters = [
	'GROUPS' => [],
	'PARAMETERS' => [
		'IBLOCK_ID' => [
			'PARENT' => 'BASE',
			'NAME' => GetMessage('T_IBLOCK_ID'),
			'TYPE' => 'LIST',
			'VALUES' => $arIBlocks,
			'REFRESH' => 'Y',
			'DEFAULT' => '',
		],
		'PROP' => [
			'PARENT' => 'BASE',
			'NAME' => GetMessage('T_PROP'),
			'TYPE' => 'LIST',
			'MULTIPLE' => 'Y',
			'ADDITIONAL_VALUES' => 'N',
			'REFRESH' => 'Y',
			'VALUES' => $arProperty,
		],
		'PROP_REQUIRED' => [
			'PARENT' => 'BASE',
			'NAME' => GetMessage('T_PROP_REQUIRED'),
			'TYPE' => 'LIST',
			'MULTIPLE' => 'Y',
			'ADDITIONAL_VALUES' => 'N',
			'REFRESH' => 'N',
			'VALUES' => $arSelectedProperty,
		],
	],
];