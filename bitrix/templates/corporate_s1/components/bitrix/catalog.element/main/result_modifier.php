<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arParams['PRICE_CODE'] = (!empty($arParams['PRICE_CODE'][0])) ? $arParams['PRICE_CODE'][0] : 'PRICE';

$arResult['PRICE'] = Array (
    'VALUE' => floatval($arResult['PROPERTIES'][$arParams['PRICE_CODE']]['VALUE']),
    'DISCOUNT_VALUE' => floatval($arResult['PROPERTIES']['OLD_PRICE']['VALUE'])
);

$arResult['PRICE']['PRINT_VALUE'] = Nextype\Corporate\CCorporate::formatPrice($arResult['PRICE']['VALUE']);
$arResult['PRICE']['PRINT_DISCOUNT_VALUE'] = Nextype\Corporate\CCorporate::formatPrice($arResult['PRICE']['DISCOUNT_VALUE']);

if (!empty($arResult['PROPERTIES']['STOCK']['VALUE']))
{
    $arResult['STOCK'] = Array (
        'TYPE' => $arResult['PROPERTIES']['STOCK']['VALUE_XML_ID'],
        'TEXT' => $arResult['PROPERTIES']['STOCK']['VALUE']
    );
}

$arPictures = Array ();

if (!empty($arResult['PREVIEW_PICTURE']))
    $arPictures[] = $arResult['PREVIEW_PICTURE'];

if (!empty($arResult['PROPERTIES']['MORE_PHOTOS']['VALUE']))
    foreach ($arResult['PROPERTIES']['MORE_PHOTOS']['VALUE'] as $pictureId)
        $arPictures[] = CFile::GetFileArray($pictureId);


if (empty($arPictures))
    $arResult['PICTURES'][] = Array (
        'PREVIEW' => SITE_TEMPLATE_PATH . "/images/no-image.jpg"
    );
else
{
    foreach ($arPictures as $arPicture)
    {
        $arResizeThumbPicture = CFile::ResizeImageGet($arPicture['ID'], Array ('width' => 100, 'height' => 100), BX_RESIZE_IMAGE_EXACT);
        $arResizePreviewPicture = CFile::ResizeImageGet($arPicture['ID'], Array ('width' => 600, 'height' => 600), BX_RESIZE_IMAGE_PROPORTIONAL_ALT);
        $arResizeDetailPicture = CFile::ResizeImageGet($arPicture['ID'], Array ('width' => 1000, 'height' => 1000), BX_RESIZE_IMAGE_PROPORTIONAL_ALT);
        $arResult['PICTURES'][] = Array (
            'THUMB' => $arResizeThumbPicture['src'],
            'PREVIEW' => $arResizePreviewPicture['src'],
            'DETAIL' => $arResizeDetailPicture['src'],
            'ALT' => $arPicture['ALT'],
            'TITLE' => $arPicture['TITLE'],
        );
    }
}

$arResult['ACTIVE_PROPERTIES'] = Array ();

foreach ($arResult['DISPLAY_PROPERTIES'] as $arProperty)
{
    if (in_array($arProperty['CODE'], Array ('ARTICLE', 'NEW', 'SALE', 'HIT', 'STOCK', 'PRICE', 'OLD_PRICE', 'MORE_PHOTOS', 'FILES', 'VIDEO')))
            continue;
    
    if (!empty($arProperty['VALUE']))
        $arResult['ACTIVE_PROPERTIES'][$arProperty['CODE']] = $arProperty;
}

if (!empty($arResult['DISPLAY_PROPERTIES']['FILES']['VALUE']))
{
    foreach ($arResult['DISPLAY_PROPERTIES']['FILES']['VALUE'] as &$file)
    {
        $file = CFile::GetFileArray($file);
        $file['FILE_SIZE'] = $file['FILE_SIZE'] / 1000;
        
        if ($file['FILE_SIZE'] < 1024)
            $file['FILE_SIZE'] = round($file['FILE_SIZE'], 0) . " " . GetMessage('FILE_SIZE_KB');
        else
            $file['FILE_SIZE'] = round($file['FILE_SIZE'] / 1024, 2) . " " . GetMessage('FILE_SIZE_MB');
    }
}

$arResult['TAGS'] = Array();

if (!empty($arParams['PROPERTY_TAGS']))
{
    foreach ($arParams['PROPERTY_TAGS'] as $tag)
    {
        if (!empty($tag) && isset($arResult['PROPERTIES'][$tag]) && !empty($arResult['PROPERTIES'][$tag]['VALUE']))
        {
            $arResult['TAGS'][] = $arResult['PROPERTIES'][$tag];
        }
    }
}