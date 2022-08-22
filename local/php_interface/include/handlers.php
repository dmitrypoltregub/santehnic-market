<?php

Bitrix\Main\EventManager::getInstance()->addEventHandler('sale', 'OnSaleComponentOrderJsData', 'OnSaleComponentOrderJsDataHandler');

function OnSaleComponentOrderJsDataHandler(&$arResult, &$arParams)
{

    if (isset($arResult['JS_DATA']['LAST_ORDER_DATA']['DELIVERY'])
        && $arResult['JS_DATA']['LAST_ORDER_DATA']['DELIVERY']!='') {
        $arResult['JS_DATA']['LAST_ORDER_DATA']['DELIVERY'] = '';}
}

