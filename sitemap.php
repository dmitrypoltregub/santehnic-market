<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Карта сайта | Сантехник Маркет");
$APPLICATION->SetTitle("Карта сайта");
?><?$APPLICATION->IncludeComponent(
	"bitrix:main.map", 
	"template1", 
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"COL_NUM" => "5",
		"LEVEL" => "5",
		"SET_TITLE" => "Y",
		"SHOW_DESCRIPTION" => "N",
		"COMPONENT_TEMPLATE" => "template1"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>