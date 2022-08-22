<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arResult['ITEMS']))
{
    $arSections = Array ();
    $rsSections = CIBlockSection::GetList(Array('SORT' => 'ASC'), Array ('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'GLOBAL_ACTIVE' => 'Y', 'SECTION_ID' => false));
    while ($arSection = $rsSections->fetch())
            $arSections[$arSection['ID']] = Array (
                'NAME' => $arSection['NAME'],
                'ITEMS' => Array ()
            ); 
            

    foreach ($arResult['ITEMS'] as $key => &$arItem)
    {

        $arResizeParams = Array (
                'width' => 300,
                'height' => 300
            );
  
            $arResizeImage = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], $arResizeParams, BX_RESIZE_IMAGE_EXACT, true);
            
            $arItem['PICTURE'] = Array (
                'SRC' => $arResizeImage['src'],
                'ALT' => $arItem['PREVIEW_PICTURE']['ALT'],
                'TITLE' => $arItem['PREVIEW_PICTURE']['TITLE'],
            );
            
            if (!empty($arItem['PROPERTIES']['PHONE']['VALUE']))
                $arItem['PROPERTIES']['PHONE']['VALUE_INT'] = \Nextype\Corporate\CCorporate::phone2int($arItem['PROPERTIES']['PHONE']['VALUE']);
            
        $arSections[$arItem['IBLOCK_SECTION_ID']]['ITEMS'][] = $arItem;
        
    }
    
    
    $arResult['ITEMS'] = $arSections;
}
