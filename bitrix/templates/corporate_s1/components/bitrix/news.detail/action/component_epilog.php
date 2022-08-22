<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach (Array ("PRODUCTS", "SERVICES") as $code)
{
    $rsValues = CIBlockElement::GetProperty($arResult['IBLOCK_ID'], $arResult['ID'], array("sort" => "asc"), Array("CODE" => $code));
    while ($arProp = $rsValues->fetch())
    {
        $arResult['PROPERTIES'][$arProp['CODE']][] = $arProp['VALUE'];
    }
}

if (is_array($arResult['PROPERTIES']['PRODUCTS']))
    $GLOBALS['arrFilterProducts']['=ID'] = $arResult['PROPERTIES']['PRODUCTS']; 

if (is_array($arResult['PROPERTIES']['SERVICES']))
    $GLOBALS['arrFilterServices']['=ID'] = $arResult['PROPERTIES']['SERVICES']; 
