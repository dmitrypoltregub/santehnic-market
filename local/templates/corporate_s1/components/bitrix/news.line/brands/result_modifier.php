<?php

foreach ($arResult['ITEMS'] as $key => $arItem)
{
    if (!empty($arItem['PREVIEW_PICTURE']['ID']))
        {
            $arResizeParams = Array (
                'width' => 270,
                'height' => 220
            );
           
            $arResizeImage = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], $arResizeParams, BX_RESIZE_IMAGE_PROPORTIONAL_ALT);
            
            $arResult['ITEMS'][$key]['PICTURE'] = Array (
                'SRC' => $arResizeImage['src'],
                'ALT' => $arItem['PREVIEW_PICTURE']['ALT'],
                'TITLE' => $arItem['PREVIEW_PICTURE']['TITLE'],
            );
        }
}
