<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (is_array($arResult['PROPERTIES']['PHOTOS']['VALUE']))
{

    $arResult['GALLERY'] = Array();
    foreach ($arResult['PROPERTIES']['PHOTOS']['VALUE'] as $value)
    {
        $arResizePreview = CFile::ResizeImageGet($value, Array('width' => 58, 'height' => 58), BX_RESIZE_IMAGE_EXACT, true);
        $arResizeDetail = CFile::ResizeImageGet($value, Array('width' => 1000, 'height' => 1000), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);

        $arResult['GALLERY'][] = Array(
            'DETAIL' => $arResizeDetail['src'],
            'PREVIEW' => $arResizePreview['src'],
        );
    }
}