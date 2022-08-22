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

// get docs

if (!empty($arResult['PROPERTIES']['DOCS']['VALUE']))
{
    foreach ($arResult['PROPERTIES']['DOCS']['VALUE'] as $id)
    {
        $file = CFile::GetFileArray($id);
        $file['FILE_SIZE'] = $file['FILE_SIZE'] / 1000;
        
        if ($file['FILE_SIZE'] < 1024)
            $file['FILE_SIZE'] = round($file['FILE_SIZE'], 0) . " " . GetMessage('FILE_SIZE_KB');
        else
            $file['FILE_SIZE'] = round($file['FILE_SIZE'] / 1024, 2) . " " . GetMessage('FILE_SIZE_MB');
        
        $arResult['DOCS'][] = $file;
    }
}