<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>

<?php
$APPLICATION->IncludeComponent(
	"maxim:form", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_ID" => "4",
		"PROP" => array(
			0 => "NAME",
			1 => "SURNAME",
			2 => "PHONE",
			3 => "EMAIL",
			4 => "COMMENT",
			5 => "FILES",
			6 => "PERSON_TYPE",
		),
		"PROP_REQUIRED" => array(
			0 => "NAME",
			1 => "SURNAME",
			2 => "PHONE",
		)
	),
	false
);
?>

<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>