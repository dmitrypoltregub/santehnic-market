<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arResult['ITEMS']))
{
    $arSections = Array ();
    $rsSections = CIBlockSection::GetList(Array('SORT' => 'ASC'), Array ('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'GLOBAL_ACTIVE' => 'Y', 'SECTION_ID' => false));
    while ($arSection = $rsSections->fetch())
            $arSections[$arSection['ID']] = Array (
                'NAME' => $arSection['NAME'],
                'ITEMS' => Array ()
            ); 
            
    
    foreach ($arResult['ITEMS'] as $key => &$arItem)
    {
        $arSections[$arItem['IBLOCK_SECTION_ID']]['ITEMS'][] = $arItem;   
    }
    
    
    $arResult['ITEMS'] = $arSections;
}
