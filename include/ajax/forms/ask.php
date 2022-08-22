<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("");

if (! \Bitrix\Main\Loader::includeModule('nextype.corporate') )
    exit();
?><?$APPLICATION->IncludeComponent(
	"nextype:corporate.forms.pro",
	"popup",
	Array(
		"CAPTCHA" => "N",
		"FIELDS" => "W3sibGFiZWwiOiJcdTA0MTJcdTA0MzBcdTA0NDhcdTA0MzUgXHUwNDM4XHUwNDNjXHUwNDRmIiwibmFtZSI6Ik5BTUUiLCJ0eXBlIjoidGV4dCIsInJlcXVpcmVkIjoiWSIsImRlZmF1bHQiOiIiLCJ2YWx1ZXMiOiIiLCJtYXNrIjoiIiwic29ydCI6IjEwMCJ9LHsibGFiZWwiOiJcdTA0MjJcdTA0MzVcdTA0M2JcdTA0MzVcdTA0NDRcdTA0M2VcdTA0M2QgXHUwNDM4XHUwNDNiXHUwNDM4IGVtYWlsIiwibmFtZSI6IkNPTlRBQ1RTIiwidHlwZSI6InRleHQiLCJyZXF1aXJlZCI6IlkiLCJkZWZhdWx0IjoiIiwidmFsdWVzIjoiIiwibWFzayI6IiIsInNvcnQiOiIyMDAifSx7ImxhYmVsIjoiXHUwNDEyXHUwNDMwXHUwNDQ4IFx1MDQzMlx1MDQzZVx1MDQzZlx1MDQ0MFx1MDQzZVx1MDQ0MSIsIm5hbWUiOiJRVUVTVElPTiIsInR5cGUiOiJ0ZXh0YXJlYSIsInJlcXVpcmVkIjoiWSIsImRlZmF1bHQiOiIiLCJ2YWx1ZXMiOiIiLCJtYXNrIjoiIiwic29ydCI6IjMwMCJ9XQ==",
		"FORM_DESCRIPTION" => "",
		"FORM_TITLE" => "Задать вопрос",
		"MESSAGE_ERRORALL" => "",
		"MESSAGE_SUCCESS" => "Ваше вопрос успешно отправлен!",
		"NAME" => "Форма задать вопрос",
		"PERSONAL_PROCESSING" => "Y",
		"PERSONAL_PROCESSING_PAGE" => "/agreement/",
		"SEND_EMAIL_ADDRESS" => "sale@santehnic-market.ru",
		"SEND_EMAIL_ENABLED" => "Y",
		"SEND_EMAIL_EVENT_NAME" => "",
		"SEND_IBLOCK_ENABLED" => "N",
		"SUBMIT_BUTTON_TEXT" => "Отправить",
		"VIEW_TYPE" => ""
	)
);?>