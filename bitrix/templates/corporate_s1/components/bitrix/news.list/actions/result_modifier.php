<?php

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
                'width' => 240,
                'height' => 240
            );
  
            $arResizeImage = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], $arResizeParams, BX_RESIZE_IMAGE_EXACT, true);
            
            $arResult['ITEMS'][$key]['PICTURE'] = Array (
                'SRC' => $arResizeImage['src'],
                'ALT' => $arItem['PREVIEW_PICTURE']['ALT'],
                'TITLE' => $arItem['PREVIEW_PICTURE']['TITLE'],
            );
        }
        
        if (!empty($arItem["PROPERTIES"]["DATE_START"]["VALUE"]) && !empty($arItem["PROPERTIES"]["DATE_END"]["VALUE"]))
        {
            $unixStartDate = MakeTimeStamp($arItem["PROPERTIES"]["DATE_START"]["VALUE"]);
            $unixEndDate = MakeTimeStamp($arItem["PROPERTIES"]["DATE_END"]["VALUE"]);

            if (time() < $unixStartDate || time() > $unixEndDate)
                $arResult['ITEMS'][$key]['DISABLED'] = "Y";
        }
        
    }
}