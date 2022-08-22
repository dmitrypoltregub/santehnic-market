<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

if (! \Bitrix\Main\Loader::includeModule('nextype.corporate') )
    die();

$uniqueId = $arResult['ITEM']['ID'] . '_' . md5($this->randString());
$arMessages = Array (
    'MESS_BTN_DETAIL' => (!empty($arParams['MESS_BTN_DETAIL'])) ? $arParams['MESS_BTN_DETAIL'] : GetMessage('DETAIL_URL_TITLE')
);

if (isset($arResult['ITEM']))
{
    if ($arParams['VIEW_MODE'] != "list")
        include __DIR__ . "/card.php";
    else
        include __DIR__ . "/list.php";
}