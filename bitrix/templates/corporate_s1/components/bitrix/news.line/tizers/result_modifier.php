<?php

foreach ($arResult['ITEMS'] as $key => $arItem)
{
    foreach ($arItem as $prop => $value)
    {
        if (strpos($prop, "PROPERTY_") !== false)
        {
            $propCode = str_replace("_VALUE", "", str_replace("PROPERTY_", "", $prop));

            if ($propCode == "LINK")
                $value = str_replace ("#SITE_DIR#", SITE_DIR, $value);
            
            $arResult['ITEMS'][$key][$propCode] = $value;
            unset($arResult['ITEMS'][$key][$prop]);
        }
        
        
    }
    
    if (!empty($arItem['PREVIEW_PICTURE']['ID']))
        {
            $arResizeParams = Array (
                'width' => 270,
                'height' => 220
            );
            if (!empty($arResult['ITEMS'][$key]['BIG_BANNER']))
                $arResizeParams = Array (
                    'width' => 570,
                    'height' => 220
                );
                
            $arResizeImage = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], $arResizeParams, BX_RESIZE_IMAGE_EXACT, true);
            
            $arResult['ITEMS'][$key]['PICTURE'] = Array (
                'SRC' => $arResizeImage['src']
            );
        }
}

if (!empty($arParams['BLOCK_MORE_LINK']))
    $arParams['BLOCK_MORE_LINK'] = str_replace ("#SITE_DIR#", SITE_DIR, $arParams['BLOCK_MORE_LINK']);