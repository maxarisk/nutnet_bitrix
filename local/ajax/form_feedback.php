<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use maxim\Form;

if (!\Bitrix\Main\Loader::includeModule('iblock')) { // checks for iblock module
	echo json_encode(['error' => 'Не подключен модуль инфоблоков']);
	die();
}

if (!check_bitrix_sessid()) { // checks for sessid
	echo json_encode(['error' => 'Ошибка сессии']);
	die();
}

$request = \Bitrix\Main\Context::getCurrent()->getRequest(); // get request
$formid = $request->getPost('formid');

if (empty($formid)) { // checks for formid
	echo json_encode(['error' => 'Незадано id формы']);
	die();
}

$session = \Bitrix\Main\Application::getInstance()->getSession(); // get session

// checks for iblock_id in session
$formObj = $session->get($formid);
if (!is_object($formObj)) {
	echo json_encode(['error' => 'Ошибка сессии: отсутствуют параметры']);
	die();
} else {
	$iblock_id = $formObj->getInfoBlockID();
	if (empty($iblock_id) || (int)$iblock_id <= 0) {
		echo json_encode(['error' => 'Неправильное id формы']);
		die();
	}
}

// checks for required fields in session
$required_fields = $formObj->getRequired();
if (!empty($required_fields)) {
	$empty_fields = '';
	foreach ($required_fields as $required_field) {
		$value = $request->getPost($required_field);
		if (empty($value)) {
			$empty_fields .= $required_field . PHP_EOL;
		}
	}
	if (!empty($empty_fields)) {
		echo json_encode(['error' => 'Незаполнены обязательные поля: ' . $empty_fields]);
		die();
	}
}

$el = new CIBlockElement; // new element
$PROP = []; // array for properties

$rsProps = CIBlockProperty::GetList( // get props list
	[
		'SORT' => 'ASC',
		'ID'   => 'ASC'
	],
	[
		'IBLOCK_ID' => $iblock_id,
		'ACTIVE'    => 'Y',
	]
);
while ($arProp = $rsProps->Fetch()) {
	if ('' == $arProp['CODE']) {
		$arProp['CODE'] = $arProp['ID'];
	}

	$value = $request->getPost($arProp['CODE']); // fill prop array if post code match
	if (!empty($value)) {
		$PROP[$arProp['CODE']] = $value;
	}

	$file = $request->getFile($arProp['CODE']);
	if (!empty($file) && $arProp['PROPERTY_TYPE'] == 'F') { // files condition
		$arFile = [];
		for ($i = 0; $i < count($file['name']); $i++) {
			$arFile[] = [ // setup new array in such a way that bitrix can candle the 'add' operation
				"VALUE" => [
					"name"     => $file['name'][$i],
					"size"     => $file['size'][$i],
					"tmp_name" => $file['tmp_name'][$i],
					"type"     => $file['type'][$i]
				],
				"DESCRIPTION" => "",
			];
		}
		$PROP[$arProp['CODE']] = $arFile;
	}
}

$fields = [
	"DATE_CREATE" => date("d.m.Y H:i:s"),
	"IBLOCK_ID" => $iblock_id,
	"NAME" => "Сообщение с формы обратной связи",
	"ACTIVE" => "Y",
	"PROPERTY_VALUES" => $PROP,
];

if($el_id = $el->Add($fields))
	echo json_encode(['success' => 'Сообщение отправлено!']);
else
	echo json_encode(['error' => 'Ошибка: ' . $el->LAST_ERROR]);
