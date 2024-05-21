<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use maxim\Form;

if (!\Bitrix\Main\Loader::includeModule('iblock')) { // checks for iblock module
	return;
}

if (!empty($arParams['IBLOCK_ID']) && (int)$arParams['IBLOCK_ID'] > 0 && !empty($arParams['PROP'])) { // checks if we have all data
	$arParams['FORM_ID'] = $this->GetEditAreaId('form_feedback');

	$session = \Bitrix\Main\Application::getInstance()->getSession();
	//$session->remove($arParams['FORM_ID']);
	$formObj = $session->get($arParams['FORM_ID']); // setup form params in session for ajax
	if (!is_object($formObj)) {
		$formObj = new Form($arParams['FORM_ID']);
		$session->set($arParams['FORM_ID'], $formObj);
	}
	$formObj->setInfoBlockID($arParams['IBLOCK_ID']);

	if (!is_array($arParams['PROP'])) {
		$arParams['PROP'] = array($arParams['PROP']);
	}

	$rsProps = CIBlockProperty::GetList( // get props list
		[
			'SORT' => 'ASC',
			'ID'   => 'ASC'
		],
		[
			'IBLOCK_ID' => $arParams['IBLOCK_ID'],
			'ACTIVE'    => 'Y',
		]
	);
	while ($arProp = $rsProps->Fetch()) {
		if ('' == $arProp['CODE']) {
			$arProp['CODE'] = $arProp['ID'];
		}

		if (in_array($arProp['CODE'], $arParams['PROP'])) { // checks for selected props
			$arResult['FIELDS'][$arProp['CODE']] = [ // setup fields
				'TYPE'     => $arProp['PROPERTY_TYPE'],
				'NAME'     => $arProp['NAME'],
			];

			$propList = [];
			if ($arProp['PROPERTY_TYPE'] == 'L') { // get enums for list type property
				$rsEnum = CIBlockProperty::GetPropertyEnum(
					$arProp['CODE'], 
					[
						"SORT"=>"asc"
					],
					[]
				);
				while($arEnum = $rsEnum->GetNext()) {
					$propList[] = [
						'VALUE'       => $arEnum['VALUE'],
						'ID' => $arEnum['ID'],
					];
				}
			}

			if ($arProp['PROPERTY_TYPE'] == 'F' && $arProp['MULTIPLE'] == 'Y') { // checks for multiple file
				$arResult['FIELDS'][$arProp['CODE']]['MULTIPLE'] = 'Y';
			}

			if (in_array($arProp['CODE'], $arParams['PROP_REQUIRED'])) { // checks if prop is required
				$arResult['FIELDS'][$arProp['CODE']]['REQUIRED'] = 'Y';
				$formObj->addRequired($arProp['CODE']);
			} else {
				$formObj->removeRequired($arProp['CODE']);
			}

			if (!empty($propList))
				$arResult['FIELDS'][$arProp['CODE']]['OPTIONS'] = $propList;
		}
	}
}

$this->IncludeComponentTemplate($componentPage);