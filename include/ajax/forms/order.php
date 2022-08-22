<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("");
define("NO_KEEP_STATISTIC", true);

if (! \Bitrix\Main\Loader::includeModule('nextype.corporate') )
    exit();
?><?$APPLICATION->IncludeComponent(
	"nextype:corporate.forms.pro",
	"popup",
	Array(
		"CAPTCHA" => "N",
		"FIELDS" => "W3sibGFiZWwiOiJcdTA0MTJcdTA0MzBcdTA0NDhcdTA0MzUgXHUwNDM4XHUwNDNjXHUwNDRmIiwibmFtZSI6Ik5BTUUiLCJ0eXBlIjoidGV4dCIsInJlcXVpcmVkIjoiWSIsImRlZmF1bHQiOiIiLCJ2YWx1ZXMiOiIiLCJtYXNrIjoiIiwic29ydCI6IjEwMCJ9LHsibGFiZWwiOiJcdTA0MWFcdTA0M2VcdTA0M2RcdTA0NDJcdTA0MzBcdTA0M2FcdTA0NDJcdTA0M2RcdTA0NGJcdTA0MzkgXHUwNDQyXHUwNDM1XHUwNDNiXHUwNDM1XHUwNDQ0XHUwNDNlXHUwNDNkIiwibmFtZSI6IlBIT05FIiwidHlwZSI6InRleHQiLCJyZXF1aXJlZCI6IlkiLCJkZWZhdWx0IjoiIiwidmFsdWVzIjoiIiwibWFzayI6Iis3ICgjIyMpICMjIy0jIy0jIyIsInNvcnQiOiIyMDAifSx7ImxhYmVsIjoiXHUwNDIyXHUwNDNlXHUwNDMyXHUwNDMwXHUwNDQwIiwibmFtZSI6IlBST0RVQ1QiLCJ0eXBlIjoidGV4dCIsInJlcXVpcmVkIjoiWSIsImRlZmF1bHQiOiI9eyRfUkVRVUVTVFtcdTAwMjdQUk9EVUNUXHUwMDI3XX0iLCJ2YWx1ZXMiOiIiLCJtYXNrIjoiIiwic29ydCI6IjMwMCJ9LHsibGFiZWwiOiJcdTA0MWFcdTA0M2VcdTA0M2NcdTA0M2NcdTA0MzVcdTA0M2RcdTA0NDJcdTA0MzBcdTA0NDBcdTA0MzhcdTA0MzkiLCJuYW1lIjoiQ09NTUVOVCIsInR5cGUiOiJ0ZXh0YXJlYSIsInJlcXVpcmVkIjoiWSIsImRlZmF1bHQiOiIiLCJ2YWx1ZXMiOiIiLCJtYXNrIjoiIiwic29ydCI6IjQwMCJ9XQ==",
		"FORM_DESCRIPTION" => "",
		"FORM_TITLE" => "Оформить заказ",
		"MESSAGE_ERRORALL" => "",
		"MESSAGE_SUCCESS" => "Ваш заказ успешно отправлен!",
		"NAME" => "Форма заказа товара",
		"PERSONAL_PROCESSING" => "Y",
		"PERSONAL_PROCESSING_PAGE" => "/agreement/",
		"SEND_EMAIL_ADDRESS" => "sale@santehnic-market.ru",
		"SEND_EMAIL_ENABLED" => "Y",
		"SEND_EMAIL_EVENT_NAME" => "",
		"SEND_IBLOCK_ENABLED" => "N",
		"SUBMIT_BUTTON_TEXT" => "Заказать",
		"VIEW_TYPE" => ""
	)
);?>
<? require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"; ?>