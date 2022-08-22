<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();



foreach ($arResult['SECTIONS'] as $key => $arItem)
{
    if ($arItem['RELATIVE_DEPTH_LEVEL'] > 1)
    {
        unset ($arResult['SECTIONS'][$key]);
	continue;
    }
    
    if (!empty($arItem['PICTURE']['ID']))
        {
            $arResizeParams = Array (
                'width' => 240,
                'height' => 240
            );
  
            $arResizeImage = CFile::ResizeImageGet($arItem['PICTURE']['ID'], $arResizeParams, BX_RESIZE_IMAGE_PROPORTIONAL, true);
            
            $arResult['SECTIONS'][$key]['PICTURE']['SRC'] = $arResizeImage['src'];
        }
        
}
