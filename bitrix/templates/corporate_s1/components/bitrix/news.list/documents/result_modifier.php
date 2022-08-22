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
        
        if (empty($arItem['PROPERTIES']['FILE']['VALUE']))
            continue;

        $file = CFile::GetFileArray($arItem['PROPERTIES']['FILE']['VALUE']);
        $file['FILE_SIZE'] = $file['FILE_SIZE'] / 1000;
        
        if ($file['FILE_SIZE'] < 1024)
            $file['FILE_SIZE'] = round($file['FILE_SIZE'], 0) . " " . GetMessage('FILE_SIZE_KB');
        else
            $file['FILE_SIZE'] = round($file['FILE_SIZE'] / 1024, 2) . " " . GetMessage('FILE_SIZE_MB');
        
        $arItem['FILE'] = $file;
        
        $arSections[$arItem['IBLOCK_SECTION_ID']]['ITEMS'][] = $arItem;
        
    }
    
    
    $arResult['ITEMS'] = $arSections;
}
