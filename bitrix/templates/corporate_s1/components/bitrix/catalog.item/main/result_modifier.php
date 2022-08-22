<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

if (empty($arResult['ITEM']['PREVIEW_PICTURE']))
    $arResult['ITEM']['PREVIEW_PICTURE'] = Array (
        'SRC' => SITE_TEMPLATE_PATH . "/images/no-image.jpg",
        'ALT' => "",
        'TITLE' => ""
    );
else
{
    $arResizePicture = CFile::ResizeImageGet($arResult['ITEM']['PREVIEW_PICTURE']['ID'], Array ('width' => 200, 'height' => 200), BX_RESIZE_IMAGE_PROPORTIONAL_ALT);
    $arResult['ITEM']['PREVIEW_PICTURE']['SRC'] = $arResizePicture['src'];
}


$arParams['PROPERTY_PRICE'] = (!empty($arParams['PROPERTY_PRICE'])) ? $arParams['PROPERTY_PRICE'] : 'PRICE';
$arParams['PROPERTY_OLD_PRICE'] = (!empty($arParams['PROPERTY_OLD_PRICE'])) ? $arParams['PROPERTY_OLD_PRICE'] : 'OLD_PRICE';

$arResult['ITEM']['PRICE'] = Array (
    'VALUE' => floatval($arResult['ITEM']['PROPERTIES'][$arParams['PROPERTY_PRICE']]['VALUE']),
    'DISCOUNT_VALUE' => floatval($arResult['ITEM']['PROPERTIES'][$arParams['PROPERTY_OLD_PRICE']]['VALUE'])
);

$arResult['ITEM']['PRICE']['PRINT_VALUE'] = Nextype\Corporate\CCorporate::formatPrice($arResult['ITEM']['PRICE']['VALUE']);
$arResult['ITEM']['PRICE']['PRINT_DISCOUNT_VALUE'] = Nextype\Corporate\CCorporate::formatPrice($arResult['ITEM']['PRICE']['DISCOUNT_VALUE']);

if (!empty($arResult['ITEM']['PROPERTIES']['STOCK']['VALUE']))
{
    $arResult['ITEM']['STOCK'] = Array (
        'TYPE' => $arResult['ITEM']['PROPERTIES']['STOCK']['VALUE_XML_ID'],
        'TEXT' => $arResult['ITEM']['PROPERTIES']['STOCK']['VALUE']
    );
}

$arResult['ITEM']['TAGS'] = Array();

if (!empty($arParams['PROPERTY_TAGS']))
{
    foreach ($arParams['PROPERTY_TAGS'] as $tag)
    {
        if (!empty($tag) && isset($arResult['ITEM']['PROPERTIES'][$tag]) && !empty($arResult['ITEM']['PROPERTIES'][$tag]['VALUE']))
        {
            $arResult['ITEM']['TAGS'][] = $arResult['ITEM']['PROPERTIES'][$tag];
        }
    }
}


$sectionID = (!empty($arResult['ITEM']['~IBLOCK_SECTION_ID'])) ? $arResult['ITEM']['~IBLOCK_SECTION_ID'] : $arResult['ITEM']['IBLOCK_SECTION_ID'];
if (!empty($sectionID))
{
    $arSection = CIBlockSection::GetByID($sectionID)->fetch();
    $arResult['ITEM']['SECTION'] = Array (
        'NAME' => $arSection['NAME']
    );
}