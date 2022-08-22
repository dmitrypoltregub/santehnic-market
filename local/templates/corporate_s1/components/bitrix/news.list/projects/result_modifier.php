<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arResult['ITEMS']))
{
    foreach ($arResult['ITEMS'] as $key => &$arItem)
    {
        $arResult['ITEMS'][$key]['PICTURE'] = Array (
            'SRC' => SITE_TEMPLATE_PATH . '/images/no-image.png',
            'ALT' => $arItem['NAME'],
            'TITLE' => $arItem['NAME'],
        );
        
        if (!empty($arItem['PREVIEW_PICTURE']['ID']))
        {
            $arResizeParams = Array (
                'width' => 270,
                'height' => 180
            );
  
            $arResizeImage = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], $arResizeParams, BX_RESIZE_IMAGE_EXACT, true);
            
            $arResult['ITEMS'][$key]['PICTURE'] = Array (
                'SRC' => $arResizeImage['src'],
                'ALT' => $arItem['PREVIEW_PICTURE']['ALT'],
                'TITLE' => $arItem['PREVIEW_PICTURE']['TITLE'],
            );
        }
        
    }
}