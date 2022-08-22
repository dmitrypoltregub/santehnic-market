<?php

foreach ($arResult as $key => $arItem)
{
    if (!isset($arItem["ID"]))
        continue;
    
    $arResizeImage = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], Array ('width' => 200, 'height' => 200), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
    $arResult[$key]['PICTURE'] = $arResizeImage;
}