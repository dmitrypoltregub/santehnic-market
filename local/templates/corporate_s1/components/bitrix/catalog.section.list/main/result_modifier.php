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
    if($arResult['SECTIONS'][$key]['DEPTH_LEVEL']==1)
    {
        $result = \Bitrix\Iblock\SectionTable::GetList(['filter' => ['IBLOCK_ID' => $arParams['IBLOCK_ID'], 'IBLOCK_SECTION_ID' => $arResult['SECTIONS'][$key]['ID']], 'select' => ['ID', 'NAME', 'CODE']]);
        while ($subsection = $result->fetch()) {
            $arResult['SECTIONS'][$key]['SUBSECTIONS'][] = $subsection;
        }
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

