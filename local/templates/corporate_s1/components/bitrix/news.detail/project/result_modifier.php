<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// relative elements

foreach (Array ('REVIEWS', 'PROJECTS') as $code)
{
    if (!empty($arResult['PROPERTIES'][$code]['VALUE']))
    {
        foreach ($arResult['PROPERTIES'][$code]['VALUE'] as $id)
        {
            $arItem = CIBlockElement::GetByID($id)->GetNext();
            if (!empty($arItem))
            {
                $rsProps = CIBlockElement::GetProperty($arItem['IBLOCK_ID'], $arItem['ID'], array("sort" => "asc"));
                while ($arProp = $rsProps->fetch())
                    $arItem['PROPERTIES'][$arProp['CODE']] = $arProp;
                
                $arResult[$code][] = $arItem;
            }
            
        }
    }
}

// get gallery images

if (is_array($arResult['PROPERTIES']['GALLERY']['VALUE']))
{

    $arResult['GALLERY'] = Array();
    foreach ($arResult['PROPERTIES']['GALLERY']['VALUE'] as $value)
    {
        $arResizePreview = CFile::ResizeImageGet($value, Array('width' => 58, 'height' => 58), BX_RESIZE_IMAGE_EXACT, true);
        $arResizeDetail = CFile::ResizeImageGet($value, Array('width' => 1000, 'height' => 1000), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);

        $arResult['GALLERY'][] = Array(
            'DETAIL' => $arResizeDetail['src'],
            'PREVIEW' => $arResizePreview['src'],
        );
    }
}