<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if (! \Bitrix\Main\Loader::includeModule('nextype.corporate') )
    die();

$APPLICATION->IncludeComponent(
	"nextype:corporate.basket",
	"",
	Array()
);
