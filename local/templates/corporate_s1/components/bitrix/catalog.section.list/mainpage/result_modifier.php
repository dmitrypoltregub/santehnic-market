<?php

foreach ($arResult['SECTIONS'] as $key => $arItem)
{
    if (!empty($arItem['PICTURE']['ID']))
        {
            $arResizeParams = Array (
                'width' => 240,
                'height' => 240
            );
  
            $arResizeImage = CFile::ResizeImageGet($arItem['PICTURE']['ID'], $arResizeParams, BX_RESIZE_IMAGE_EXACT, true);
            
            $arResult['SECTIONS'][$key]['PICTURE'] = Array (
                'SRC' => $arResizeImage['src'],
            );
        }
		$get_fields = CIBlockSection::GetList(
		array(),
		array(
			'IBLOCK_ID' => $arParams['IBLOCK_ID'],
			'ID' => $arResult['SECTIONS'][$key]['ID']
		),
		false,
		array(
			'UF_*'
		)
	);
	
	if($get_fields_item = $get_fields->GetNext()) { 

		$arResult['SECTIONS'][$key]['DETAIL_DESC'] = $get_fields_item['UF_DETALE_DESC'];
							
	}
        
}

if (!empty($arParams['BLOCK_MORE_LINK']))
    $arParams['BLOCK_MORE_LINK'] = str_replace ("#SITE_DIR#", SITE_DIR, $arParams['BLOCK_MORE_LINK']);