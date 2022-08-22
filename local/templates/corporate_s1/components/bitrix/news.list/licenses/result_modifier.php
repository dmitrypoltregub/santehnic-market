<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arResult['ITEMS']))
{
    $arSections = Array();
    $rsSections = CIBlockSection::GetList(Array('SORT' => 'ASC'), Array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'GLOBAL_ACTIVE' => 'Y', 'SECTION_ID' => false));
    while ($arSection = $rsSections->fetch())
        $arSections[$arSection['ID']] = Array(
            'NAME' => $arSection['NAME'],
            'ITEMS' => Array()
        );


    foreach ($arResult['ITEMS'] as $key => &$arItem)
    {
        if (empty($arItem['PREVIEW_PICTURE']['ID']))
            continue;

        $arResizePreview = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], Array('width' => 300, 'height' => 300), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
        $arResizeDetail = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], Array('width' => 700, 'height' => 700), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);

        $arItem['PICTURE'] = Array(
            'PREVIEW' => $arResizePreview['src'],
            'DETAIL' => $arResizeDetail['src'],
            'ALT' => $arItem['PREVIEW_PICTURE']['ALT'],
            'TITLE' => $arItem['PREVIEW_PICTURE']['TITLE'],
        );



        $arSections[$arItem['IBLOCK_SECTION_ID']]['ITEMS'][] = $arItem;
    }


    $arResult['ITEMS'] = $arSections;
}
