<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResizeParams = Array('width' => 870, 'height' => 300);

if (is_array($arResult['DETAIL_PICTURE']))
{
    $arResize = CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'], $arResizeParams, BX_RESIZE_IMAGE_EXACT, true);
    $arResult['PICTURE'] = Array (
        'ALT' => $arResult['DETAIL_PICTURE']['ALT'],
        'TITLE' => $arResult['DETAIL_PICTURE']['TITLE'],
        'SRC' => $arResize['src']
    );
}
elseif (is_array($arResult['PREVIEW_PICTURE']))
{
    $arResize = CFile::ResizeImageGet($arResult['PREVIEW_PICTURE']['ID'], $arResizeParams, BX_RESIZE_IMAGE_EXACT, true);
    $arResult['PICTURE'] = Array (
        'ALT' => $arResult['PREVIEW_PICTURE']['ALT'],
        'TITLE' => $arResult['PREVIEW_PICTURE']['TITLE'],
        'SRC' => $arResize['src']
    );
}

if (!empty($arResult['PROPERTIES']["DATE_START"]["VALUE"]) && !empty($arResult['PROPERTIES']["DATE_END"]["VALUE"]))
        {
            $unixStartDate = MakeTimeStamp($arResult["PROPERTIES"]["DATE_START"]["VALUE"]);
            $unixEndDate = MakeTimeStamp($arResult["PROPERTIES"]["DATE_END"]["VALUE"]);

            if (time() < $unixStartDate || time() > $unixEndDate)
                $arResult['DISABLED'] = "Y";
        }